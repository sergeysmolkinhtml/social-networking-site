<select  wire:model.defer="state.bday"
         class="mt-4 border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sn"
         id="bday">

        <option value="">{{__('Day')}}</option>
        @for($day = 1; $day <= 31;$day++)
            <option value="{{ sprintf("%02d", $day) }}">{{$day}}</option>
        @endfor
</select>
<x-input-error for="bday" class="mt-2"/>

    <select wire:model.defer="state.bmonth"
            class="mt-4 border-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm">
        <option value="">{{__('Month')}}</option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>
<x-input-error for="bmonth" class="mt-2"/>

    <select wire:model.defer="state.byear"
            class="mt-4 border-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm">
        <option value="">{{__('Year')}}</option>

        @for($year = 2004; $year >= 1900;$year--)
            <option value="{{$year}}">{{$year}}</option>
        @endfor
    </select>
<x-input-error for="byear" class="mt-2"/>


