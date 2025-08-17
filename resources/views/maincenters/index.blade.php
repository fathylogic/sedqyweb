@extends('layouts.app')

@section('content')
<style>







ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25C6";
  color: green;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المراكز الرئيسية</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('maincenters.create') }}"><i class="fa fa-plus"></i>&nbsp;
                    اضافة مركز رئيسي جديد</a>
            </div>
        </div>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession

    <div class="card">

        




<div class="row">
<div class="col-md-4">
<ul id="myUL">

  @foreach ($data as $key => $main)
    <li><span class="caret h5">{{ $main->name }}</span>
        <span class="badge bg-primary rounded-pill float-end "> {{ $main->centers->count() }} </span>
        <a href="{{ route('maincenters.show',$main->id) }}" class="btn btn-sm btn-icon item-edit waves-effect waves-light">
                                    <i class="text-primary ti ti-pencil   float-end"></i>
                                </a>
       
        
        <ul class="nested">
             @if($main->centers->count()>0)
        @foreach ($main->centers as $center)
            <li>
                <i class="fa fa-circle"></i>&nbsp;
            <a href="{{ route('centers.show',$center->id) }}" >   {{ $center->center_name }} </a>
            
            </li>
         @endforeach
          @endif

           <li><a href="#"><i class="fa fa-circle-plus"></i>&nbsp;<b>  اضافة مركز فرعي </b></a></li>
        </ul>

       
    </li>

  @endforeach

</ul>
</div>
<div class="col-md-8">
    تفاصيل اللي هضغط عليه 
</div>
</div>


    
        
    </div>

    <script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>
    <script>
        function fn_delete_center(id) {
            Swal.fire({
                title: "هل انت متأكد من انك تريد الحذف ?",
                text: "لا يمكنك استرجاعها مرة أخرى!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "إلغاء",
                confirmButtonText: "نعم,  احذف!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./centers/destroy/" + id
                }
            });
        }
    </script>
    {!! $data->links('pagination::bootstrap-5') !!}

    <p class="text-center text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>
@endsection
