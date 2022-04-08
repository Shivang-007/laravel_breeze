<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <form action="" method="post">
        @csrf
        <label for="title">Title</label>
        <br>
        <input type="text" name='title'>
        <br>
        <label for="Body">Body</label>
        <br>
        <textarea name="body" id="" cols="30" rows="10"></textarea>
        <br>
        <button type="submit" style="background-color: green">Add Post</button>
    </form>
    <br>
    
      @if(session()->has('status'))
      <div>
         <h4 style="color:blue"> {{session('status')}}</h4>
    </div>
      @endif
    
</x-app-layout>
