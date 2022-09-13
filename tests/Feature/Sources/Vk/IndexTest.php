<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * Попытка посещения гостем
 */
test('guest', function () {
    $this->get(routeBuilderHelper()->parsingSource->vk->index())->assertRedirect(routeBuilderHelper()->auth->login());
});

/**
 * Попытка посещения гостем
 */
test('not admin', function () {
    authHelper()->signIn();
    $this->get(routeBuilderHelper()->parsingSource->vk->index())->assertForbidden();
});

/**
 * Успешное открытие страницы
 */
test('success', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $response = $this->get(routeBuilderHelper()->parsingSource->vk->index());
    $response->assertOk();

    $response->assertSeeText($vkParsingSource->title);
    $response->assertSeeText($vkParsingSource->url);
    $response->assertSeeText('Not Parsed');
});

/**
 * Отображение записи со статусом парсинга "Успешно"
 */
test('parsed status success', function () {
    $date = new DateTime('2022-01-01 13:45');

    modelBuilderHelper()->parsingSource->vk->create(
        ['parsing_status' => 'success', 'parsed_at' => $date]
    );

    authHelper()->signInAsAdmin();

    $response = $this->get(routeBuilderHelper()->parsingSource->vk->index());
    $response->assertOk();

    $response->assertSeeText('Success');
    $response->assertSeeText($date->format('d-m-Y H:i'));
});

/**
 * Отображение записи со статусом парсинга "Неуспешно"
 */
test('parsed status failed', function () {
    $date = new DateTime('2022-01-01 13:45');

    $parsingStatusDescription = 'Parsing failed';

    modelBuilderHelper()->parsingSource->vk->create(
        ['parsing_status' => 'failed', 'parsing_status_description' => $parsingStatusDescription, 'parsed_at' => $date]
    );

    authHelper()->signInAsAdmin();

    $response = $this->get(routeBuilderHelper()->parsingSource->vk->index());
    $response->assertOk();

    $response->assertSeeText('Failed');
    $response->assertSee($parsingStatusDescription);
    $response->assertSeeText($date->format('d-m-Y H:i'));
});
