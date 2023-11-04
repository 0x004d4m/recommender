<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Repositories\InteractionRepository;
use App\Repositories\LikeRepository;
use App\Repositories\PostRepository;
use App\Repositories\RateRepository;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class PostServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $postRepositoryMock;
    protected $likeRepositoryMock;
    protected $rateRepositoryMock;
    protected $interactionRepositoryMock;
    protected $postService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->postRepositoryMock = Mockery::mock(PostRepository::class);
        $this->likeRepositoryMock = Mockery::mock(LikeRepository::class);
        $this->rateRepositoryMock = Mockery::mock(RateRepository::class);
        $this->interactionRepositoryMock = Mockery::mock(InteractionRepository::class);
        $this->postService = new PostService($this->postRepositoryMock, $this->likeRepositoryMock, $this->rateRepositoryMock, $this->interactionRepositoryMock);
    }

    public function testGetPosts()
    {
        // Arrange
        $user = User::factory()->create();
        $expectedPostsCollection = new Collection([
            new Post(['title' => 'title 1', 'description' => 'description 1', 'keywords' => 'keywords 1, keywords 2, keywords 3']),
            new Post(['title' => 'title 2', 'description' => 'description 2', 'keywords' => 'keywords 4, keywords 5, keywords 6']),
            new Post(['title' => 'title 3', 'description' => 'description 3', 'keywords' => 'keywords 7, keywords 8, keywords 9']),
        ]);

        // Expectation
        $this->postRepositoryMock->shouldReceive('list')
            ->once()
            ->andReturn($expectedPostsCollection);
        $this->interactionRepositoryMock->shouldReceive('count')
            ->once()
            ->andReturn(0);

        // Act
        $posts = $this->postService->getPosts($user->id);

        // Assert
        $this->assertInstanceOf(Collection::class, $posts);
        $this->assertCount(3, $posts);
        $this->assertEquals('title 1', $posts->first()->title);
        $this->assertEquals('title 3', $posts->last()->title);
    }

    public function testToggleLikePost()
    {
        // Arrange
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $this->likeRepositoryMock->shouldReceive('toggle')
            ->once()
            ->andReturn(true);

        // Act
        $toggleLikePost = $this->postService->toggleLikePost($post->id, $user->id);

        // Assert
        $this->assertTrue($toggleLikePost);
    }

    public function testRatePost()
    {
        // Arrange
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $this->rateRepositoryMock->shouldReceive('create')
            ->once()
            ->andReturn(true);

        // Act
        $ratePost = $this->postService->ratePost($post->id, $user->id, 5);

        // Assert
        $this->assertTrue($ratePost);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
