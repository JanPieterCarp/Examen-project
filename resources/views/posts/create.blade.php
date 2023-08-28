<x-layout>

    <section class="px-6 py-8 max-w-md mx-auto">
        <h1 class="text-lg font-bold mb-4 text-center">Publish a new post</h1>
        <x-panel>
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" type="text"/>

            <x-form.input name="slug" type="text"/>

            <x-form.input name="thumbnail" type="file"/>

            <x-form.textarea name="excerpt" />

            <x-form.textarea name="body" />




            <x-form.field>
                <x-form.label name="category"/>
                    <select name="category_id" id="category_id">
                        @foreach (\App\Models\Category::all() as $category) {
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : ''}}>
                                {{ ucwords($category->name) }}</option>
                            }
                        @endforeach
                    </select>

                <x-form.error name="category" />
            </x-form.field>

            <x-form.submit-button> Post </x-form.submit-button>

        </form>
    </section>
    </x-panel>
</x-layout>
