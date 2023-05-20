<?php /** @noinspection DuplicatedCode */

declare(strict_types=1);

namespace Confetti\Components;

use Confetti\Helpers\ComponentEntity;
use Confetti\Helpers\ComponentStandard;
use Confetti\Helpers\ComponentStore;
use Confetti\Helpers\ContentStore;
use Confetti\Helpers\HasMapInterface;
use RuntimeException;

return new class extends ComponentStandard implements HasMapInterface {
    public function get(): string
    {
        $component = $this->componentStore->findOrNull($this->key);
        if ($component !== null) {
            return $this->getValueFromOptions($component);
        }
        $component = $this->componentStore->findOrNull($this->key . '/-');
        if ($component !== null) {
            return $this->getValueFromFileInDirectories($component);
        }
        return '!!! Error: Component with type `select` need to have decoration `options` or `fileInDirectories` !!!';
    }

    public function getValueFromOptions(ComponentEntity $component): string
    {
        // Get saved value
        $content = $this->contentStore->find($this->id);
        if ($content !== null) {
            return $content->value;
        }

        // Get default value
        if ($component->hasDecoration('default')) {
            return $component->getDecoration('default')['value'];
        }

        // Get first option
        $options = $component->getDecoration('options')['options'];
        if (count($options) === 0) {
            return '';
        }
        return $component->getDecoration('options')['options'][0]['id'];
    }

    public function getValueFromFileInDirectories(ComponentEntity $component): string
    {
        // Get saved value
        $objectPath = $this->contentStore->find($this->id)?->value;
        if ($objectPath !== null) {
            if (str_ends_with($objectPath, '.blade.php')) {
                return self::getViewByPath($objectPath);
            }
            return $objectPath;
        }

        // Get default view
        $objectPath = $component->getDecoration('default')['value'] ?? throw new RuntimeException('Error: No default defined. Use ->default(\'filename_without_directory\') to define the default value. In ' . $component->source);
        if (str_ends_with($objectPath, '.blade.php')) {
            return self::getViewByPath($objectPath);
        }
        return $objectPath;
    }

    public static function getDefaultOption(ComponentEntity $component): string
    {
        return $component->getDecoration('default')['value'] ?? '';
    }

    public static function getAllOptions(ComponentEntity $component): array
    {
        $options = [];
        if ($component->hasDecoration('fileInDirectories')) {
            $targets  = $component->getDecoration('fileInDirectories')['targets'];
            foreach ($targets as $target) {
                $objects = new ComponentStore($target);
                foreach ($objects->whereMatch($target) as $object) {
                    $options[$object->key] = self::fileNameToLabel($object->source->file);
                }
            }
        }
        if ($component->hasDecoration('options')) {
            foreach ($component->getDecoration('options')['options'] as $option) {
                $options[$option['id']] = $option['label'];
            }
        }
        return $options;
    }

    public function toMap(): Map
    {
        return new Map(
            $this->id . '/-',
            new ComponentStore($this->id . '/-'),
            new ContentStore(),
        );
    }

    private static function getViewByPath(string $path): string
    {
        $path = str_replace('.blade.php', '', $path);
        $path  = preg_replace('/^\/object/', '', $path);
        return str_replace('/', '.', $path);
    }

    private static function fileNameToLabel(string $file): string
    {
        $name = basename($file, '.blade.php');
        $name = str_replace(['-', '_'], ' ', $name);
        return ucwords($name);
    }
};
