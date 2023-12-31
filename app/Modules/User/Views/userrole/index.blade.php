@extends('Admin::layouts.master')
@section('body')

    <?php
    use Illuminate\Support\Facades\Input;
    ?>
    <div class="block-header block-header-2">
        <h2 class="pull-left">
            Role User
        </h2>

        <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        LIST OF ROLES USER
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                            <thead>
                            <tr>
                                <th>Serial no</th>
                                <th> Email</th>
                                <th> User name</th>
                                <th> Number</th>
                                <th> Status</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                                <?php
                                $total_rows = 1;
                                ?>
                                @foreach($data as $values)
                                    <tr>
                                        <td>
                                            <?=$total_rows?>
                                        </td>
                                        <td>
                                            {{$values->email}}
                                        </td>
                                        <td>
                                            {{$values->first_name}} {{$values->last_name}}
                                        </td>
                                        <td>
                                            {{$values->mobile_no}}
                                        </td>
                                        <td>
                                            {{$values->status}}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.roles.user', $values->id) }}"
                                               class="btn btn-primary btn-xs font-10">Roles User</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $total_rows++;
                                    ?>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $('#data-table-responsive').attr('data-page-length', '50');
    </script>
@endsection