<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ArticleControllerTest extends TestCase
{
  use RefreshDatabase;
    
  public function testIndex()
  {
      $response = $this->get(route('articles.index'));
      // 正常レスポンスを示す200を渡す
      $response->assertStatus(200)
      // ステータスコードが200かどうかをテストするだけでは、記事一覧画面が表示されているかどうかをテストできていません。そのため、ビューについてもテストを行うことにしています。
          ->assertViewIs('articles.index');
      // $responseのステータスコードが200であればテストに合格
  }
  public function testGuestCreate()
  {
      $response = $this->get(route('articles.create'));

      $response->assertRedirect(route('login'));
  }
  public function testAuthCreate()
  {
      $user = factory(User::class)->create();

      $response = $this->actingAs($user)
          ->get(route('articles.create'));

      $response->assertStatus(200)
          ->assertViewIs('articles.create');
  }
}
