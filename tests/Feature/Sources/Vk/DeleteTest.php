<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * Попытка удаления гостем
 */
test('guest', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    $this->delete(routeBuilderHelper()->parsingSource->vk->delete($vkParsingSource->id))->assertRedirect(routeBuilderHelper()->auth->login());
});

/**
 * Попытка удаления гостем
 */
test('not admin', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signIn();
    $this->delete(routeBuilderHelper()->parsingSource->vk->delete($vkParsingSource->id))->assertForbidden();
});

/**
 * Попытка удаления несуществующего источника
 */
test('not exists', function () {
    authHelper()->signInAsAdmin();

    $this->delete(routeBuilderHelper()->parsingSource->vk->delete(999))->assertNotFound();
});

/**
 * Успешное удаления
 */
test('success', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $this->delete(routeBuilderHelper()->parsingSource->vk->delete($vkParsingSource->id))
        ->assertSessionHasNoErrors()
        ->assertSessionHas('alert.success');

    $this->assertDatabaseMissing(
        'vk_parsing_sources',
        ['id' => $vkParsingSource->id, 'deleted_at' => null]
    );
});
