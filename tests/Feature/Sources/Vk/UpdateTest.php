<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

use function Pest\Faker\faker;

/**
 * Попытка посещения гостем
 */
test('guest', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id))->assertRedirect(routeBuilderHelper()->auth->login());
});

/**
 * Попытка посещения гостем
 */
test('not admin', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signIn();
    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id))->assertForbidden();
});

/**
 * Попытка посещения страницы редактирования несуществующего источника
 */
test('not exists', function () {
    authHelper()->signInAsAdmin();

    $this->patch(routeBuilderHelper()->parsingSource->vk->update(999))->assertNotFound();
});

/**
 * Попытка отправки пустых данных
 */
test('empty', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id))
        ->assertSessionHasErrors(['title', 'url']);
});

/**
 * Попытка изменения со слишком коротким заголовком
 */
test('too short title', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id), ['title' => 't'])
        ->assertSessionHasErrors(['title']);
});

/**
 * Попытка изменения со слишком длинным заголовком
 */
test('too long title', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id), ['title' => faker()->sentence(100)])
        ->assertSessionHasErrors(['title']);
});

/**
 * Попытка изменения с текстом, не являющимся url
 */
test('not url', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id), ['url' => 'test'])
        ->assertSessionHasErrors(['url']);
});

/**
 * Попытка изменения с url, не являющимся url vk
 */
test('not vk url', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id), ['url' => 'https://test.ru'])
        ->assertSessionHasErrors(['url']);
});

/**
 * Попытка изменения с url, который уже добавлен
 */
test('already', function () {
    $vkParsingSource        = modelBuilderHelper()->parsingSource->vk->create();
    $vkParsingSourceExisted = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();
    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id), ['url' => $vkParsingSourceExisted->url])
        ->assertSessionHasErrors(['url']);
});

/**
 * Успешное изменение
 */
test('success', function () {
    $vkParsingSource        = modelBuilderHelper()->parsingSource->vk->create();
    $vkParsingSourceUpdated = modelBuilderHelper()->parsingSource->vk->make();

    authHelper()->signInAsAdmin();

    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id), $vkParsingSourceUpdated->toArray())
        ->assertSessionHasNoErrors()
        ->assertSessionHas('alert.success');

    $this->assertDatabaseHas(
        'vk_parsing_sources',
        ['id' => $vkParsingSource->id, 'title' => $vkParsingSourceUpdated->title, 'url' => $vkParsingSourceUpdated->url]
    );
});

/**
 * Успешное изменение с таким же параметрами
 */
test('success same', function () {
    $vkParsingSource        = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $this->patch(routeBuilderHelper()->parsingSource->vk->update($vkParsingSource->id), $vkParsingSource->toArray())
        ->assertSessionHasNoErrors()
        ->assertSessionHas('alert.success');
});
