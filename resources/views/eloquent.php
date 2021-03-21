<?= '<?php' ?>
<?php
/**
 * @var \Barryvdh\LaravelIdeHelper\Alias[][] $eloquent_by_alias_ns
 */
?>

// @formatter:off

/**
 * A helper file for Laravel, to provide autocomplete information to your IDE
 * Generated for Laravel <?= $version ?>.
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */

<?php foreach ($eloquent_by_alias_ns as $namespace => $aliases) : ?>
    namespace <?= $namespace == '__root' ? '' : trim($namespace, '\\') ?> {
    <?php foreach ($aliases as $alias) : ?>
        <?= $alias->getClassType() ?> <?= $alias->getShortName() ?> extends <?= $alias->getExtends() ?> {<?php if ($alias->getExtendsNamespace() == '\Illuminate\Database\Eloquent') : ?>
            <?php foreach ($alias->getMethods() as $method) : ?>
                <?= trim($method->getDocComment('            ')) ?>
                public static function <?= $method->getName() ?>(<?= $method->getParamsWithDefault() ?>)
                {<?php if ($method->getDeclaringClass() !== $method->getRoot()) : ?>
                    //Method inherited from <?= $method->getDeclaringClass() ?>
                <?php endif; ?>

                <?php if ($method->isInstanceCall()) : ?>
                    /** @var <?=$method->getRoot()?> $instance */
                <?php endif?>
                <?= $method->shouldReturn() ? 'return ' : '' ?><?= $method->getRootMethodCall() ?>;
                }
            <?php endforeach; ?>
        <?php endif; ?>}
    <?php endforeach; ?>
    }

<?php endforeach; ?>
