@extends('app')

@section('content')

    <div class="jumbotron">
        
        <h1>You Notices</h1>
    </div>
   <table class="table table-striped table-bordered">
       
       <thead>
           <tr>
               <th>This Content:</th>
               <th>Accessible Here:</th>
               <th>Is Infringing Upon My Work Here:</th>
               <th>Notice Sent:</th>
               <th>Content Removed:</th>
           </tr>
       </thead>

        <tbody>

            @foreach($notices as $notice)
                <tr>
                    <td>{{ $notice->infringing_title }}</td>
                    <td>{{ $notice->infringing_link }}</td>
                    <td>{{ $notice->original_link }}</td>
                    <td>{{ $notice->created_at->diffForHumans() }}</td>
                    <td>
                        {!! Form::open() !!}
                            
                            <div class="form-group">
                                
                                {!! Form::checkbox('content_removed', $notice->content_removed, $notice->content_removed) !!}

                            </div>
                    
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </tbody>
   </table>

@endsection