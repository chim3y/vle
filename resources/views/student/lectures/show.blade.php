
@extends('layouts.index')
@section('title', 'Lecture| Show')
@section('main_title')
@endsection
@section('sub_title', 'Show')
@section ('current_page', 'Show')
@section ('stylesheets')
<script type="text/javascript" src="https://www.docxjs.com/js/build/latest.docxjs.min.js"> </script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="https://www.docxjs.com/js/build/latest.docxjs.min.js"></script>
@endsection
@section ('content')
<br/>

<div class="row">
<div class="col-sm-10 col-sm-offset-2" >



<div class="row">
<div class="form-group">

<body>
    <input id="inputFiles" type="file hidden" name="files[]" multiple="false">
    <div id="loaded-layout" style="width:100%;height:800px;"></div>
</body>

    <iframe src="https://docs.google.com/viewerng/viewer?   }}"></iframe>


</div>
</div>

</div>


</div>
@endsection
@push('scripts')
     <script>
            $(document).ready(function(){
                var $inputFiles = $('#inputFiles');
                $inputFiles.on('change', function (e) {
                    var files = e.target.files;
                    var docxJS = new DocxJS();

                    docxJS.parse(
                        files[0],
                        function () {
                            docxJS.render($('#loaded-layout')[0], function (result) {
                                if (result.isError) {
                                    console.log(result.msg);
                                } else {
                                    console.log("Success Render");
                                }
                            });
                        }, function (e) {
                            console.log("Error!", e);
                        }
                    );
                });
            });
        </script>
@endpush


