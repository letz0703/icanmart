<div class="card flex flex-col mt-2">
    <h2 class="font-normal py-3 -ml-5 border-l-4 border-blue-300 pl-4 mb-3">
        Invite Members
    </h2>
    <form method="post" action="{{$project->path().'/invitations'}}" class="text-sm ">
        @csrf
        <input type="email" name="email"
               class="w-full border-2 border-gray-400 rounded p-2"
               placeholder="birdboard member email"
        >
        <button type="submit" name="invite" class="button text-sm mt-2">Invite</button>
    </form>
    @include('errors',['bag' => 'invitations'])
</div>
