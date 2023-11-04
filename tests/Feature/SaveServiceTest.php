<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Save;
use App\Models\User;
use App\Repositories\SaveRepository;
use App\Services\SaveService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class SaveServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $saveRepositoryMock;
    protected $saveService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->saveRepositoryMock = Mockery::mock(SaveRepository::class);
        $this->saveService = new SaveService($this->saveRepositoryMock);
    }

    public function testList(): void
    {
        // Arrange
        $user = User::factory()->create();
        $expectedSavesCollection = new Collection([
            new Save(['user_id' => $user->id, 'post_id' => 1]),
        ]);

        // Expectation
        $this->saveRepositoryMock->shouldReceive('list')
            ->once()
            ->andReturn($expectedSavesCollection);

        // Act
        $saves = $this->saveService->list($user->id);

        // Assert
        $this->assertInstanceOf(Collection::class, $saves);
        $this->assertCount(1, $saves);
        $this->assertEquals($user->id, $saves->first()->user_id);
        $this->assertEquals(1, $saves->first()->post_id);
    }
    public function testToggle(): void
    {
        // Arrange
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $this->saveRepositoryMock->shouldReceive('toggle')
            ->once()
            ->andReturn(true);

        // Act
        $toggleLikePost = $this->saveService->toggle($post->id, $user->id);

        // Assert
        $this->assertTrue($toggleLikePost);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
