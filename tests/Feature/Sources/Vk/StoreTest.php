<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

use function Pest\Faker\faker;

/**
 * Попытка посещения гостем
 */
test('guest', function () {
    $this->post(routeBuilderHelper()->parsingSource->vk->store())->assertRedirect(routeBuilderHelper()->auth->login());
});

/**
 * Попытка посещения гостем
 */
test('not admin', function () {
    authHelper()->signIn();
    $this->post(routeBuilderHelper()->parsingSource->vk->store())->assertForbidden();
});

/**
 * Попытка отправки пустых данных
 */
test('empty', function () {
    authHelper()->signInAsAdmin();
    $this->post(routeBuilderHelper()->parsingSource->vk->store())
        ->assertSessionHasErrors(['title', 'url']);
});

/**
 * Попытка создания со слишком коротким заголовком
 */
test('too short title', function () {
    authHelper()->signInAsAdmin();
    $this->post(routeBuilderHelper()->parsingSource->vk->store(), ['title' => 't'])
        ->assertSessionHasErrors(['title']);
});

/**
 * Попытка создания со слишком длинным заголовком
 */
test('too long title', function () {
    authHelper()->signInAsAdmin();
    $this->post(routeBuilderHelper()->parsingSource->vk->store(), ['title' => faker()->sentence(100)])
        ->assertSessionHasErrors(['title']);
});

/**
 * Попытка создания с текстом, не являющимся url
 */
test('not url', function () {
    authHelper()->signInAsAdmin();
    $this->post(routeBuilderHelper()->parsingSource->vk->store(), ['url' => 'test'])
        ->assertSessionHasErrors(['url']);
});

/**
 * Попытка создания с url, не являющимся url vk
 */
test('not vk url', function () {
    authHelper()->signInAsAdmin();
    $this->post(routeBuilderHelper()->parsingSource->vk->store(), ['url' => 'https://test.ru'])
        ->assertSessionHasErrors(['url']);
});

/**
 * Попытка создания с url, который уже добавлен
 */
test('already', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();
    $this->post(routeBuilderHelper()->parsingSource->vk->store(), ['url' => $vkParsingSource->url])
        ->assertSessionHasErrors(['url']);
});

/**
 * Успешное добавление
 */
test('success', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->make();

    authHelper()->signInAsAdmin();
    $this->post(routeBuilderHelper()->parsingSource->vk->store(), $vkParsingSource->toArray())
        ->assertSessionHasNoErrors()
        ->assertSessionHas('alert.success')
        ->assertRedirect(route('parsing-source.vk.index'));

    $this->assertDatabaseHas('vk_parsing_sources', ['title' => $vkParsingSource->title, 'url' => $vkParsingSource->url]);
});
