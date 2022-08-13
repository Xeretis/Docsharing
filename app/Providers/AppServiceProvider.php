<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        /**
         * Flatten an array while keeping it's keys, even non-incremental numeric ones, in tact.
         *
         * Unless $dotNotification is set to true, if nested keys are the same as any
         * parent ones, the nested ones will supersede them.
         *
         * @param int $depth How many levels deep to flatten the array
         * @param bool $dotNotation Maintain all parent keys in dot notation
         */
        Collection::macro('flattenKeepKeys', function ($depth = 1, $dotNotation = false) {
            if ($depth) {
                $newArray = [];
                foreach ($this->items as $parentKey => $value) {
                    if (is_array($value)) {
                        $valueKeys = array_keys($value);
                        foreach ($valueKeys as $key) {
                            $subValue = $value[$key];
                            $newKey = $key;
                            if ($dotNotation) {
                                $newKey = "$parentKey.$key";
                                if ($dotNotation !== true) {
                                    $newKey = "$dotNotation.$newKey";
                                }

                                if (is_array($value[$key])) {
                                    $subValue = collect($value[$key])->flattenKeepKeys($depth - 1, $newKey)->toArray();
                                }
                            }
                            $newArray[$newKey] = $subValue;
                        }
                    } else {
                        $newArray[$parentKey] = $value;
                    }
                }

                $this->items = collect($newArray)->flattenKeepKeys(--$depth, $dotNotation)->toArray();
            }

            return collect($this->items);
        });
    }
}
