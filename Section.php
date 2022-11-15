<?php /** @noinspection ALL */
// @formatter:off
// phpcs:ignoreFile
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\MultipleItemsFoundException;
use Illuminate\Support\Traits\EnumeratesValues;

/**
 * @return \Section
 */
function section(string $key): \Section
{
    $faker     = \Faker\Factory::create('lorem');
    $faker->addProvider(new Faker\Provider\Lorem($faker));
    return new Section($faker, $key);
};

/**
 * @return \Section
 */
function extentSection(string $key): \Section
{
    $faker     = \Faker\Factory::create('lorem');
    $faker->addProvider(new Faker\Provider\Lorem($faker));
    return new Section($faker, $key);
};

function request(): mixed
{
};

class Section
{
    private string $key;

    public function __construct(private \Faker\Generator $faker, string $key)
    {
        $this->key = $key;
    }

    public function section(string $key): self
    {
        return $this;
    }

    public function get(string $key): string
    {
        return $this;
    }

    public function list(string... $columns): self
    {
        return $this;
    }

    public function label(string $label): self
    {
        return $this;
    }

    public function text(string $key): Text
    {
        return new Text($this->faker, "$this->key.$key");
    }

    public function textarea(string $key): Textarea
    {
        return new Textarea($this->faker, "$this->key.$key");
    }

    public function number(string $key): Number
    {
        return new Number($this->faker, "$this->key.$key");
    }

    public function url(string $key): Url
    {
        return new Url($this->faker, "$this->key.$key");
    }

    public function image(string $key): Image
    {
        return new Image($this->faker, "$this->key.$key");
    }

    public function checkbox(string $key): Checkbox
    {
        return new Checkbox($this->faker, "$this->key.$key");
    }

    public function color(string $key): Color
    {
        return new Color($this->faker, "$this->key.$key");
    }

    public function date(string $key): NotImplemented
    {
        return new NotImplemented($this->faker, "$this->key.$key");
    }

    public function dateTime(string $key): NotImplemented
    {
        return new NotImplemented($this->faker, "$this->key.$key");
    }

    public function email(string $key): Email
    {
        return new Email($this->faker, "$this->key.$key");
    }

    public function month(string $key): NotImplemented
    {
        return new NotImplemented($this->faker, "$this->key.$key");
    }

    public function radio(string $key): NotImplemented
    {
        return new NotImplemented($this->faker, "$this->key.$key");
    }

    public function select(string $key): Select
    {
        return new Select($this->faker, "$this->key.$key");
    }

    public function telephone(string $key): NotImplemented
    {
        return new NotImplemented($this->faker, "$this->key.$key");
    }

    public function time(string $key): NotImplemented
    {
        return new NotImplemented($this->faker, "$this->key.$key");
    }

    public function thumb(string $key): Image
    {
    }

    public function where(string $key, mixed $value): Section
    {
    }

    public function first(): ?Section
    {
    }

    /** @return \Section[] */
    public function multiple(string $key): Multiple
    {
        return new Multiple($this->faker, "$this->key.$key");
    }
}

final class Multiple implements ArrayAccess, Countable, IteratorAggregate
{
    /**
     * The items contained in the collection.
     *
     * @var array<TKey, TValue>
     */
    protected $items = [];

    public function __construct(private \Faker\Generator $faker, private string $key)
    {
        $component = (new \App\Services\ComponentRepository())->find($this->key);

        $max = $component->maxApply ? $component->max : 100;

        $amount = random_int($component->min, $max);

        $i = 1;
        while ($i <= $amount) {
            $i++;

            $this->items[] = new Section($this->faker, "$component->key");
        }
    }

    public function label(string $label): self
    {
        return $this;
    }

    /** @return \Section[] */
    public function min(int $min): self
    {
        return $this;
    }

    /** @return \Section[] */
    public function max(int $max): self
    {
        return $this;
    }

    /** @return \Section[] */
    public function sortable(): self
    {
        return $this;
    }

    /** @return \Section[] */
    public function bulkUpload(string $keyToUpload): self
    {
        return $this;
    }

    /** @return \Section[] */
    public function where(string $keyToCompare, string $operatorOrValue, string $value = null): self
    {
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator<TKey, TValue>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param TKey $key
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * Get an item at a given offset.
     *
     * @param TKey $key
     * @return TValue
     */
    public function offsetGet($key): mixed
    {
        return $this->items[$key];
    }

    /**
     * Set the item at a given offset.
     *
     * @param TKey|null $key
     * @param TValue    $value
     * @return void
     */
    public function offsetSet($key, $value): void
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     *
     * @param TKey $key
     * @return void
     */
    public function offsetUnset($key): void
    {
        unset($this->items[$key]);
    }

}

final class Text
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    public function min(int $min): self
    {
        return $this;
    }

    public function max(int $max): self
    {
        return $this;
    }

    /**
     * @param string|null $label If not specified it will search for a translation.
     */
    public function label(string $label = null): self
    {
        return $this;
    }

    /**
     * @param string $default
     */
    public function default(string|int $default): self
    {
        return $this;
    }

    /**
     * @param string|null $placeholder If not specified, we will use the label.
     */
    public function placeholder(string $placeholder = null): self
    {
        return $this;
    }

    public function help(string $help = null): self
    {
        return $this;
    }

    public function urlFriendly(): self
    {
        return $this;
    }

    public function translate(): self
    {
        return $this;
    }

    public function required(): self
    {
        return $this;
    }

    public function unique(): self
    {
        return $this;
    }

    public function __toString(): string
    {
        $component = (new \App\Services\ComponentRepository())->find($this->key);

        if ($component->default != '') {
            return $component->default;
        }

        $haystack = strtolower($component->key . $component->label);
        if (str_contains($haystack, 'address')) {
            return $this->faker->address();
        }
        if (str_contains($haystack, 'first') && str_contains($haystack, 'name')) {
            return $this->faker->firstName();
        }
        if (str_contains($haystack, 'last') && str_contains($haystack, 'name')) {
            return $this->faker->lastName();
        }
        if (str_contains($haystack, 'company') || str_contains($haystack, 'company') || str_contains($haystack, 'business')) {
            return $this->faker->company();
        }
        if (str_contains($haystack, 'mail')) {
            return $this->faker->email();
        }
        if (str_contains($haystack, 'phone')) {
            return $this->faker->phoneNumber();
        }
        if (str_contains($haystack, 'city')) {
            return $this->faker->city();
        }
        if (str_contains($haystack, 'name')) {
            return $this->faker->name();
        }

        $max = $component->maxApply ? $component->max : 255;
        $min = max($component->min, 6);
        if ($min > $max) {
            $min = 1;
        }

        return $this->faker->text(random_int($min, $max));
    }
}

final class Textarea
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    public function min(int $min): self
    {
        return $this;
    }

    public function max(int $max): self
    {
        return $this;
    }

    /**
     * @param string|null $label If not specified it will search for a translation.
     */
    public function label(string $label = null): self
    {
        return $this;
    }

    /**
     * @param string|null $placeholder If not specified, we will use the label.
     */
    public function placeholder(string $placeholder = null): self
    {
        return $this;
    }

    public function help(string $help = null): self
    {
        return $this;
    }

    public function translate(): self
    {
        return $this;
    }

    public function required(): self
    {
        return $this;
    }

    public function __toString(): string
    {
        $component = (new \App\Services\ComponentRepository())->find($this->key);

        $min = max($component->min, 6);
        $max = $component->maxApply ? $component->max : 255;

        return $this->faker->text(random_int($min, $max));
    }
}

final class Number
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    public function min(int $min): self
    {
        return $this;
    }

    public function max(int $max): self
    {
        return $this;
    }

    public function label(string $label = null): self
    {
        return $this;
    }

    /**
     * @param string|null $placeholder If not specified, we will use the label.
     */
    public function placeholder(string $placeholder = null): self
    {
        return $this;
    }

    public function help(string $help = null): self
    {
        return $this;
    }

    public function required(): self
    {
        return $this;
    }

    public function __toString(): string
    {
        $component = (new \App\Services\ComponentRepository())->find($this->key);

        $min = $component->minApply ? $component->min : -1000000000000;
        $max = $component->maxApply ? $component->max : 1000000000000;
        return $this->faker->numberBetween($min, $max);
    }
}

final class Checkbox
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    public function label(string $label = null): self
    {
        return $this;
    }

    public function help(string $help = null): self
    {
        return $this;
    }

    public function required(): self
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->faker->boolean(70) ? '1' : '0';
    }
}

final class Color
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    public function label(string $label = null): self
    {
        return $this;
    }

    public function help(string $help = null): self
    {
        return $this;
    }

    public function required(): self
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->faker->hexColor();
    }
}

final class Select
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    public function fromDirectory(string $directory): self
    {
        return $this;
    }

    public function fromSection(string $key): Section
    {
        return $this;
    }

    public function label(string $label = null): self
    {
        return $this;
    }

    public function help(string $help = null): self
    {
        return $this;
    }

    public function options(array $options): self
    {
        return $this;
    }

    public function required(): self
    {
        return $this;
    }

    public function __toString(): string
    {
        $component = (new \App\Services\ComponentRepository())->find($this->key);

        return $component->options[rand(0, count($component->options) - 1)]['label'];
    }
}

final class NotImplemented
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    public function label(string $label = null): self
    {
        return $this;
    }

    public function help(string $help = null): self
    {
        return $this;
    }

    public function required(): self
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->faker->lorum();
    }
}

final class Email
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    public function label(string $label = null): self
    {
        return $this;
    }

    public function placeholder(string $label = null): self
    {
        return $this;
    }

    public function help(string $help = null): self
    {
        return $this;
    }

    public function required(): self
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->faker->email();
    }
}

final class Url
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    public function intern(): self
    {
    }

    /**
     * @param string|null $label If not specified it will search for a translation.
     */
    public function label(string $label = null): self
    {
    }

    /**
     * @param string|null $placeholder If not specified, we will use the label.
     */
    public function placeholder(string $placeholder = null): self
    {
        return $this;
    }

    public function help(string $help = null): self
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->faker->url();
    }
}

final class Image
{
    public function __construct(private \Faker\Generator $faker, private string $key)
    {
    }

    /**
     * @param string|null $label If not specified it will search for a translation.
     */
    public function label(string $label = null): self
    {
        return $this;
    }

    public function required(): self
    {
        return $this;
    }

    public function onlyIf(\App\Services\Component $component, string $comparison, mixed $value): self
    {
        return $this;
    }

    public function width(int $px): self
    {
        return $this;
    }

    public function widthMax(int $px): self
    {
        return $this;
    }

    public function widthMin(int $px): self
    {
        return $this;
    }

    public function height(int $px): self
    {
        return $this;
    }

    public function heightMax(int $px): self
    {
        return $this;
    }

    public function heightMin(int $px): self
    {
        return $this;
    }

    public function ratio(int $with, int $height): self
    {
        return $this;
    }

    public function autoCrop(): self
    {
        return $this;
    }

    public function translate(): self
    {
        // todo
    }

    public function __toString(): string
    {
        $component = (new \App\Services\ComponentRepository())->find($this->key);

        // Calculate width
        $widthMax = $component->widthMax !== 0 ? $component->widthMax : 2400;
        $width    = $this->faker->numberBetween($component->widthMin, $widthMax);
        if ($component->width !== 0) {
            $width = $component->width;
        }

        // Calculate height
        $heightMax = $component->heightMax !== 0 ? $component->heightMax : 2400;
        $height    = $this->faker->numberBetween($component->heightMin, $heightMax);
        if ($component->height !== 0) {
            $height = $component->height;
        }

        // Calculate by ratio
        if ($component->ratioWidth !== 0) {
            $height = $width / $component->ratioWidth * $component->ratioHeight;
        }

        $width  = round($width);
        $height = round($height);

        $randomNumber = $this->faker->randomNumber();

        return "https://picsum.photos/$width/$height?random=$randomNumber";
    }
}

