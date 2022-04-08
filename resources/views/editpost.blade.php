<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <form action="" method="post">
        
        @csrf
        @method('PUT')
        <label for="title">Title</label>
        <br>
        <input type="text" name='title' value="{{$post->title}}">
        <br>
        <label for="Body">Body</label>
        <br>
        <textarea name="body" id="" cols="30" rows="10">{{$post->body}}</textarea>
        <br>
        <button type="submit" style="background-color: green">Update</button>
    </form>
    <br>
    
     
    
</x-app-layout>
