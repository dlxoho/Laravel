<?php

namespace Tests\Feature;

use App\Models\User;
use App\Service\NoticeService; // 서비스 위치 확인 (Service vs Services)
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoticeServiceTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function 공지사항이_정상적으로_생성된다()
  {
    // 1. 준비
    $user = User::factory()->create();
    $this->actingAs($user);

    $service = app(NoticeService::class);

    // 오타 방지를 위해 변수에 담기
    $testTitle = '테스트 제목입니다.';
    $testContent = '테스트 내용입니다.';

    $data = [
      'title' => $testTitle,
      'content' => $testContent,
    ];

    // 2. 실행
    $result = $service->storeNoticeWithFiles($data);

    // 3. 검증
    // 서비스가 배열을 반환하므로 배열 키로 접근합니다.
    $this->assertEquals(201, $result['resultCode']);
    $this->assertEquals('SUCCESS', $result['resultMessage']);

    // DB에 값이 정확히 들어갔는지 확인
    $this->assertDatabaseHas('notices', [
      'title' => $testTitle,
      'content' => $testContent,
      'user_id' => $user->id,
    ]);
  }
}
