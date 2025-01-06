@extends('layouts.admin')
@section('content')
<form method="POST" action='{{ route("admin.graphs.update", [$graph->id]) }}' enctype="multipart/form-data" id="grahForm">
    <input name='id' type='hidden' value='{{$graph->id}}' id="id"/>
    @method('PUT')
    @csrf
<div class="card">
    <div class="card-header">
        Cartographier
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.graph.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $graph->name) }}" required maxlength="32">
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="type">{{ trans('cruds.graph.fields.type') }}</label>
                    <select class="form-control select2-free {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                        @if (!$type_list->contains(old('type')))
                            <option> {{ old('type') }}</option>
                        @endif
                        @foreach($type_list as $t)
                            <option {{ (old('type') ? old('type') : $graph->type) == $t ? 'selected' : '' }}>{{$t}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row resizable-div" id="myDiv">
            <div class="col-lg-12">
                        <table width="100%">
                            <tr>
                                <td width="400">
                                    <div class="form-group">
                                        <select class="form-control select2" id="filters" multiple>
                                            <option value="1">{{ trans("cruds.report.cartography.ecosystem") }}</option>
                                            <option value="2">{{ trans("cruds.report.cartography.information_system") }}</option>
                                            <option value="3">{{ trans("cruds.report.cartography.applications") }}</option>
                                            <option value="4">{{ trans("cruds.report.cartography.administration") }}</option>
                                            <option value="5">{{ trans("cruds.report.cartography.logical_infrastructure") }}</option>
                                            <option value="9">{{ trans("cruds.flux.title") }}</option>
                                            <option value="6">{{ trans("cruds.report.cartography.physical_infrastructure") }}</option>
                                            <option value="7">{{ trans("cruds.report.cartography.network_infrastructure") }}</option>
                                            <option value="8">{{ trans("cruds.physicalLink.title") }}</option>
                                        </select>
                                        <span class="help-block">{{ trans("cruds.report.explorer.filter_helper") }}</span>
                                    </div>
                                </td>
                                <td width=10>
                                </td>
                                <td width="400">
                                    <div class="form-group">
                                        <select class="form-control select2" id="node">
                                            <option></option>
                                        </select>
                                        <span class="help-block">{{ trans("cruds.report.explorer.object_helper") }}</span>
                                    </div>
                                </td>
                                <td style="text-align: center; vertical-align: top; width=100px;">
                                  <div
                                    style="
                                      display: flex;
                                      justify-content: center;
                                      align-items: center;
                                      width: 50px;
                                      height: 40px;
                                      border: 0px solid #007bff;
                                      border-radius: 8px;">
                                          <img id="nodeImage" src=""
                                          style="width: 32px; cursor: grab;"/>
                                    </div>
                                </td>
                                <td style="vertical-align: top; " >
                                  <div id="maximizeBtn"
                                    style="
                                      text-align: right;
                                      display: flex;
                                      justify-content: right;
                                      align-items: center;
                                      width: 100%;
                                      height: 40px;
                                      border: 0px solid #007bff;
                                      border-radius: 8px;">
                                          <i
                                          class="fas fa-angle-up"
                                          style="cursor: pointer; color: #7C123E">
                                        </i>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div id="app-container" style="display: flex; height: 100vh;">
                            <div id="sidebar" style="width: 50px; background: #ffffff; border-right: 1px solid #ddd; padding: 10px;">

                                <i id="saveButton" title="Save" class="mapping-icon fas fa-save"></i>
                                <i id="undoButton" title="Undo" class="mapping-icon fas fa-rotate-left"></i>
                                <i id="redoButton" title="Redo" class="mapping-icon fas fa-rotate-right"></i>
                                <i id="font-btn" title="Text" class="mapping-icon fas fa-font" draggable="true"></i>
                                <i id="square-btn" title="Border" class="mapping-icon fas fa-vector-square" draggable="true"></i>
                                <i id="group-btn" title="Group" class="mapping-icon fas fa-object-group"></i>
                                <i id="ungroup-btn" title="Ungroup" class="mapping-icon fas fa-object-ungroup"></i>
                                <i id="zoom-in-btn" class="mapping-icon fas fa-plus"></i>
                                <i id="zoom-out-btn" class="mapping-icon fas fa-minus"></i>
                                <i id="download-btn" class="mapping-icon fas fa-download"></i>

                            </div>

                            <!-- Context Menu for edges -->
                            <div id="context-menu" style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; z-index: 1000; padding: 10px;">
                                <label for="edge-color-select">Couleur :</label>
                                <select id="edge-color-select">
                                    <option value="#000000">Noir</option>
                                    <option value="#ff0000">Rouge</option>
                                    <option value="#00ff00">Vert</option>
                                    <option value="#0000ff">Bleu</option>
                                    <option value="#ffa500">Orange</option>
                                </select>
                                <br>
                                <label for="edge-thickness-select">Épaisseur :</label>
                                <select id="edge-thickness-select">
                                    <option value="1">1 px</option>
                                    <option value="2">2 px</option>
                                    <option value="3">3 px</option>
                                    <option value="4">4 px</option>
                                    <option value="5">5 px</option>
                                </select>
                                <br>
                                <button id="apply-edge-style">Appliquer</button>
                            </div>

                        <div id="graph-container" style="position: relative; overflow: hidden; width: 800px; height: 600px; cursor: default; touch-action: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <a class="btn btn-default" href="{{ route('admin.graphs.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</form>
@endsection

@section('styles')
@vite('resources/css/mapping.css')
@endsection

@section('scripts')

<script>
// TODO : optimize me
let _nodes = new Map();
@foreach($nodes as $node)
    _nodes.set( "{{ $node["id"] }}" ,{ id: "{{ $node["id"]}}", vue: "{{ $node["vue"]}}", label: "{!! str_replace('"','\\"',$node["label"]) !!}", {!! array_key_exists('title',$node) ? ('title: "' . $node["title"] . '",') : "" !!} image: "{{ $node["image"] }}",  type: "{{ $node["type"] }}", edges: [ <?php
    foreach($edges as $edge) {
        if ($edge["from"]==$node["id"])
            echo '{attachedNodeId:"' . $edge["to"] . ($edge["name"]!==null ? '",name:"' . $edge["name"] : ""). '",edgeType:"' . $edge["type"] .'", edgeDirection: "TO", bidirectional:'. ($edge["bidirectional"]?"true":"false") . '},';
        if ($edge["to"]==$node["id"])
            echo '{attachedNodeId:"' . $edge["from"] . ($edge["name"]!==null ? '",name:"' . $edge["name"] : ""). '",edgeType:"' . $edge["type"] .'", edgeDirection: "FROM", bidirectional:' . ($edge["bidirectional"]?"true":"false") . '},';
        } ?> ]});
@endforeach

$(document).ready(function () {
    // initialize select2
    $('.select2').select2();
    $('.select2-free').select2({
        placeholder: "{{ trans('global.pleaseSelect') }}",
        allowClear: true,
        tags: true
    });

    function apply_filter() {
        // Get current filter
        cur_filter = $('#filters').val();

        // Get filter size
        if (cur_filter.length==0) {
            for (let [node, value] of _nodes)
                $("#node").append('<option value="' + value.id + '">' + value.label + '</option>');
        }
        else
        {
            // filter nodes
            let activated=0, disabled=0;
            $("#node").empty();
            for (let [node, value] of _nodes) {
                if (cur_filter.includes(value.vue)) {
                    $("#node").append('<option value="' + value.id + '">' + value.label + '</option>');
                    activated++;
                    }
                else
                    disabled++;
            }
        }
        // clear node
        $('#node').val(null).trigger("change");
        // clear image
        document.getElementById('nodeImage').src='';
    }

    // clear selections
    $('#filters').val(null);
    $('#node').val(null);

    $('#filters')
        .on('select2:select', function(e) {
            apply_filter();
        });

    $('#filters')
        .on('select2:unselect', function(e) {
            apply_filter();
        });

    $('#node')
        .on('select2:select', function(e) {
            // Get current filter
            cur_node = $('#node').val();
            // console.log(cur_node);
            document.getElementById('nodeImage').src=_nodes.get(cur_node).image;
        });

    $('#node')
        .on('select2:unselect', function(e) {
            document.getElementById('nodeImage').src='';
        });

    // Maximisation
    document.getElementById('maximizeBtn').addEventListener('click', function () {
        const div = document.getElementById('myDiv');
        const sidebar = document.getElementById('sidebar');

        // Vérifie si le div est déjà maximisé
        if (div.classList.contains('maximized')) {
            // Restaurer la taille initiale
            div.classList.remove('maximized');
            if (sidebar) sidebar.style.display = 'block'; // Rendre l'en-tête visible
        } else {
            // Maximiser
            div.classList.add('maximized');
            if (sidebar) sidebar.style.display = 'none'; // Masquer l'en-tête
        }
    });

    const xmlContent = `{!! $graph->content !!}`; // Injecter le contenu XML
    loadGraph(xmlContent);
});

</script>

@vite('resources/js/mapping.ts')

@endsection
