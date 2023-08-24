<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">


        <form action="/admin/posts/{{$post->id}}/edit" method="POST" enctype="multipart/form-data">
      
        @csrf 
          @method('PATCH')   
            <x-form.input name="title" :value="old('title', $post->title)" />
            <x-form.input name="slug" :value="old('slug', $post->slug)" />
            <div class="flex mt-8">
                <div class="flex-1">
                <x-form.input name="thumbnail" type="file" :value="$post->thumbnail" />
                </div>
                <img src="{{ asset('/storage/' . $post->thumbnail) }}" alt="image" class="rounded-xl" width="200">
            </div>

            <x-form.textarea name="excerpt">{{old('excerpt', $post->excerpt)}}</x-form.textarea>
            <x-form.textarea name="body">{{old('body', $post->body)}}</x-form.textarea>

            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="category_id">
                    @php
                    $categories = \App\Models\Category::all();
                    @endphp
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}>{{ucwords($category->name)}}</option>
                    @endforeach

                </select>
                <x-form.error name="category" />
            </x-form.field>



            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>

</x-layout>