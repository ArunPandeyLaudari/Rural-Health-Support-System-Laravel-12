<?php

namespace App\Rules;

use App\Models\Appointment;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class AppointmentOverlap implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // info($value);
        // $start = $value['start_time'];
        // $end = $value['end_time'];
        // $existingAppointmentId = request()->input('id');

        // $query = Appointment::where(function ($query) use ($start, $end) {
        //     $query->whereBetween('start_time', [$start, $end])
        //           ->orWhereBetween('end_time', [$start, $end]);
        // });

        // if ($existingAppointmentId) {
        //     $query->where('id', '!=', $existingAppointmentId);
        // }

        // return !$query->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The appointment overlaps with an existing appointment.';
    }
}
