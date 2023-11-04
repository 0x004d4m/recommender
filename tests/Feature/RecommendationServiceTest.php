<?php

namespace Tests\Feature;

use App\Models\Recommendation;
use App\Models\User;
use App\Repositories\RecommendationRepository;
use App\Services\RecommendationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class RecommendationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $recommendationRepositoryMock;
    protected $recommendationService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->recommendationRepositoryMock = Mockery::mock(RecommendationRepository::class);
        $this->recommendationService = new RecommendationService($this->recommendationRepositoryMock);
    }

    public function testList(): void
    {
        // Arrange
        $user = User::factory()->create();
        $expectedRecommendationsCollection = new Collection([
            new Recommendation(['user_id' => $user->id, 'recommendation' => "asd,asd,sad as,dsad,asd,sad,sda"]),
        ]);

        // Expectation
        $this->recommendationRepositoryMock->shouldReceive('list')
            ->once()
            ->andReturn($expectedRecommendationsCollection);

        // Act
        $recommendations = $this->recommendationService->list($user->id);

        // Assert
        $this->assertInstanceOf(Collection::class, $recommendations);
        $this->assertCount(1, $recommendations);
        $this->assertEquals($user->id, $recommendations->first()->user_id);
        $this->assertEquals("asd,asd,sad as,dsad,asd,sad,sda", $recommendations->first()->recommendation);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
