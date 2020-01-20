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
        class="block w-full px-3 py-2 h-56 bg-white rounded shadow appearance-none resize-none focus:outline-none"
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
    <label class="inline-block text-gray-600 mb-2">Location</label>

    <textarea
        class="block w-full px-3 py-2 h-32 bg-white rounded shadow appearance-none resize-none focus:outline-none"
        placeholder="Address or location for this event"
        name="location">{{ old('location', $event->location) }}</textarea>

    @error('location')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label class="inline-block text-gray-600 mb-2">Start Date</label>

    <date-time-picker
        value="{{ old('started_at', optional($event->started_at)->toIso8601String()) }}"
        v-on:input="$refs.started_at.value = $event"></date-time-picker>

    <input
        value="{{ old('started_at', optional($event->started_at)->toIso8601String()) }}"
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
        value="{{ old('ended_at', optional($event->ended_at)->toIso8601String()) }}"
        v-on:input="$refs.ended_at.value = $event"></date-time-picker>

    <input
        value="{{ old('ended_at', optional($event->ended_at)->toIso8601String()) }}"
        name="ended_at"
        ref="ended_at"
        type="hidden">

    @error('ended_at')
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
    <label class="inline-block text-gray-600 mb-2">Website</label>

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
    <label class="inline-block text-gray-600 mb-2">Registration</label>

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
