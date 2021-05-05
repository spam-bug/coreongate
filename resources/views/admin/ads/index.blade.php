<x-app-layout>
    <x-slot name="header">Ads</x-slot>

    <div class="container adSettings">

        <form action="{{ route('ads.store') }}" enctype="multipart/form-data" method="post">
            @csrf
                <input type="file" name="ads" accept="image/jpeg" id="imgUpload">

                <button id="adsCreate" title="add">
                    <div id="addIcon">
                        <i class="fas fa-plus"></i>
                    </div>
                </button>
        </form>

        @if($adsList->count() > 0)
            @foreach($adsList as $ads)
                <div class="adsContainer">
            
                    <img src="{{ Storage::url($ads->name) }}" alt="">
                    


                    <form action="{{ route('ads.delete', ['id' => $ads->id]) }}" method="POST" >
                        @csrf
                        @method('DELETE')
                            
                        <a id="adsDelete" href="#"
                                                onclick="event.preventDefault();
                                            if (confirm('Are you sure you want to delete this ad ?') == true) {
                                                this.closest('form').submit();
                                            }">
                            <i class="fas fa-trash"></i>
                        </a>
                    </form>
                </div>
            @endforeach
        @endif
        

        
    </div>

</x-app-layout>