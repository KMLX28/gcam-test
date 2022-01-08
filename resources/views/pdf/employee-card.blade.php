<div class="p-5">
    <div>
        {{-- the pdf libray does not support Arabic and I can search for fixes, but i have no time--}}
        <span>Name</span>
        <span>{{$cardRequest->name}}</span>
    </div>
    <div class="mt-4">
        <span>Department Name</span>
        <span>{{$cardRequest->department_name}}</span>
    </div>
    <div class="mt-4">
        <span>Expiration Date</span>
        <span>{{now()->addYear()->toDateString()}}</span>
    </div>
    <div class="mt-4">
        <span>Creation Date</span>
        <span>{{now()->toDateString()}}</span>
    </div>
    <div>
        {{-- there is probobly a better barcode type , but this is good enough--}}
        <img class="mt-8"
             width="300px"
             height="50px"
             src={{'data:image/png;base64,' . DNS1D::getBarcodePNG(now()->addYear()->toDateString(), 'CODE11',10,100)}} alt="barcode"/>
    </div>
</div>
