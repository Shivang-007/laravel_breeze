<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        @foreach(auth()->user()->notifications as $notification)
                        <div class="bg-blue-300 p-3 m-2">
                           <b>{{$notification->data['name']}}</b>  Started Following you!
                        </div>
                        
                        @endforeach
                    </div>
                    <div>
                        @if(session()->has('status'))
                        <div>
                           <h4 style="color:blue"> {{session('status')}}</h4>
                      </div>
                        @endif

                    </div>
                    <br>
                    <br>
                    <div>
                    <table style="background-color:khaki;">
                        <tr style="border: 1px solid black">
                            <th>User</th>
                            <th>Title</th>
                            <th>Body</th>
                            @can('isAdmin')
                            <th colspan="2">Opearation</th>
                            @endcan
                        </tr>
                        @foreach($posts as $posts)
        <tr>
            <td>{{$posts->user->name}}</td>
            <td>{{$posts->title}}</td>
            <td>{{$posts->body}}</td>
            @can('isAdmin') 
            <td><button><a href={{"/post/edit/".$posts['id']}} style="text-decoration: none;background-color:lightblue">Edit</a></button>  |  <button><a href={{"/post/delete/".$posts['id']}} style="text-decoration: none;background-color:red">Delete</a></button></td>
            @endcan  
        </tr>
        @endforeach
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
