<div>
    <label class="inline-block text-gray-600 mb-2">Name</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('name', $event->name) }}"
        placeholder="Name of this event"
        name="name"
        type="text"
        autofocus>

    @error('name')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Body</label>

    <textarea
        class="block w-full p-3 h-56 bg-white rounded shadow appearance-none resize-y focus:outline-none"
        placeholder="Write something nice"
        name="body">{{ old('body', $event->body) }}</textarea>

    @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Cover Image</label>

    <photo-upload
        value="{{ old('cover', $event->cover) }}"
        v-on:input="$refs.cover.value = $event"></photo-upload>

    <input
        value="{{ old('cover', $event->cover) }}"
        type="hidden"
        name="cover"
        ref="cover">

    @error('cover')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Address Line 1</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('address_line_1', $event->address_line_1) }}"
        placeholder="Street Address"
        name="address_line_1"
        type="text">

    @error('address_line_1')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Address Line 2 (optional)</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('address_line_2', $event->address_line_2) }}"
        placeholder="Building / Apartment / Suite / Lot No."
        name="address_line_2"
        type="text">

    @error('address_line_2')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="flex -mx-2">
    <div class="flex-1 px-2 mt-6">
        <label class="inline-block text-gray-600 mb-2">City</label>

        <input
            class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
            value="{{ old('city', $event->city) }}"
            placeholder="City / Municipality"
            name="city"
            type="text">

        @error('city')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-40 px-2 mt-6">
        <label class="inline-block text-gray-600 mb-2">Postal Code</label>

        <input
            class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
            value="{{ old('postal_code', $event->postal_code) }}"
            placeholder="Postal Code"
            name="postal_code"
            type="text">

        @error('postal_code')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">State</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('state', $event->state) }}"
        placeholder="State / Province"
        name="state"
        type="text">

    @error('state')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Country</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('country', $event->country ?? 'Philippines') }}"
        placeholder="Country"
        name="country"
        type="text">

    @error('country')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Google Map Embed (optional)</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('google_map_embed', $event->google_map_embed) }}"
        placeholder="Google Map Embed"
        name="google_map_embed"
        type="text">

    @error('google_map_embed')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Start Date</label>

    <date-time-picker
        value="{{ old('started_at', optional($event->started_at)->setTimezone($event->timezone)) }}"
        v-on:input="$refs.started_at.value = $event"></date-time-picker>

    <input
        value="{{ old('started_at', $event->started_at) }}"
        name="started_at"
        ref="started_at"
        type="hidden">

    @error('started_at')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">End Date</label>

    <date-time-picker
        value="{{ old('ended_at', optional($event->ended_at)->setTimezone($event->timezone)) }}"
        v-on:input="$refs.ended_at.value = $event"></date-time-picker>

    <input
        value="{{ old('ended_at', $event->ended_at) }}"
        name="ended_at"
        ref="ended_at"
        type="hidden">

    @error('ended_at')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Timezone</label>

    <div class="w-64 relative">
        <select
            class="block w-full px-3 py-2 pr-8 h-12 bg-white rounded shadow appearance-none focus:outline-none"
            name="timezone">
            @foreach(timezones() as $timezone)
            <option
                value="{{ $timezone }}"
                {{ old('timezone', $event->timezone ?? 'Asia/Manila') == $timezone ? 'selected' : '' }}>
                {{ $timezone }}
            </option>
            @endforeach
        </select>

        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
    </div>

    @error('timezone')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>


<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Host</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('host', $event->host) }}"
        placeholder="Host of this event"
        name="host"
        type="text">

    @error('host')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Website URL (optional)</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('website_url', $event->website_url) }}"
        placeholder="Marketing page for this event"
        name="website_url"
        type="text">

    @error('website_url')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Registration URL (optional)</label>

    <input
        class="block w-full px-3 py-2 h-12 bg-white rounded shadow appearance-none focus:outline-none"
        value="{{ old('registration_url', $event->registration_url) }}"
        placeholder="Link to registration for this event"
        name="registration_url"
        type="text">

    @error('registration_url')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-10">
    <button class="px-4 h-12 rounded bg-gray-700 text-white" type="submit">{{ $buttonText }}</button>
</div>
