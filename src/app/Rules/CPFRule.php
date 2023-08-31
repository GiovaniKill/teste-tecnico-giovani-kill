<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CPFRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Valida o CPF levando em consideração as regras de:
        // http://clubes.obmep.org.br/blog/a-matematica-nos-documentos-a-matematica-dos-cpfs/

        if (strlen($value) != 11) {
            return false;
        }

        //Verifica os 9 primeiros números comparando-os com o décimo
        $total = 0;
        $multiplier = 10;
        for ($i = 0; $i <= 8; $i++, $multiplier--) {
            $total += $value[$i] * $multiplier;
        }

        $remainder = $total % 11;
        if ($remainder == 0 || $remainder == 1) {
            if ($value[9] != 0) {
                return false;
            }
        } else {
            if ($value[9] != 11 - $remainder) {
                return false;
            }
        }

        //Verifica do segundo ao décimo número comparando-os com o décimo primeiro
        $total = 0;
        $multiplier = 10;
        for ($i = 1; $i <= 9; $i++, $multiplier--) {
            $total += $value[$i] * $multiplier;
        }

        $remainder = $total % 11;
        if ($remainder == 0 || $remainder == 1) {
            if ($value[10] != 0) {
                return false;
            }
        } else {
            if ($value[10] != 11 - $remainder) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CPF inválido.';
    }
}
