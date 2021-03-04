<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href={{asset('autoload/style.css')}} rel="stylesheet" type="text/css">
    <title>Table</title>
</head>
<link href={{asset('autoload/tablesort.css')}} rel='stylesheet'>
<body>


<div style="margin-top: 20px;" class="row justify-content-center">
  <div class="col-md-6">
    <table id="sort" class="table table-striped table-dark table-bordered table-hover">

      <thead>
        <tr>
          <th scope="col">Time</th>
          <th scope="col">№kol-vo</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <th scope="row">11:00-12:00</th>
          <td>23</td>
        </tr>

        <tr>
          <th scope="row">12:00-13:00</th>
          <td>65</td>
        </tr>

        <tr>
          <th scope="row">13:00-14:00</th>
          <td>552</td>
        </tr>
      </tbody>

    </table>
  </div>

<script src={{asset('autoload/tape.js')}}></script>

<script src={{asset('autoload/src/tablesort.js')}}></script>
<script src={{asset('autoload/src/sorts/tablesort.dotsep.js')}}></script>
<script src={{asset('autoload/src/sorts/tablesort.filesize.js')}}></script>
<script src={{asset('autoload/src/sorts/tablesort.date.js')}}></script>
<script src={{asset('autoload/src/sorts/tablesort.number.js')}}></script>
<script src={{asset('autoload/src/sorts/tablesort.monthname.js')}}></script>

<!-- Tests -->
<script>
table = document.getElementById('sort');
tableDescend = document.getElementById('sort-descend');
tableExclude = document.getElementById('sort-exclude');
tableDefault = document.getElementById('sort-default');
tableRefresh = document.getElementById('sort-refresh');
tableMulti = document.getElementById('sort-multi');
tableSortRowSet = document.getElementById('sort-row-set');
tableSortRowAuto = document.getElementById('sort-row-auto');
tableSortColumnKeys = document.getElementById('sort-column-keys');
new Tablesort(table);
new Tablesort(tableDescend, { descending: true });
new Tablesort(tableExclude);
new Tablesort(tableDefault);
new Tablesort(tableMulti);
new Tablesort(tableSortRowSet);
new Tablesort(tableSortRowAuto);
new Tablesort(tableSortColumnKeys);
var refresh = new Tablesort(tableRefresh);

var rowCount = tableRefresh.rows.length;
var row = tableRefresh.insertRow(rowCount);
var cellName = row.insertCell(0);
    cellName.innerHTML = 0;

refresh.refresh();
</script>

<script src={{asset('autoload/spec/tablesort.js')}}></script>
<script src={{asset('autoload/spec/dotsep.js')}}></script>
<script src={{asset('autoload/spec/multibody.js')}}></script>
<script src={{asset('autoload/spec/filesize.js')}}></script>
<script src={{asset('autoload/spec/date.js')}}></script>
<script src={{asset('autoload/spec/number.js')}}></script>
<script src={{asset('autoload/spec/monthname.js')}}></script>
</div>
</body>
</html>
