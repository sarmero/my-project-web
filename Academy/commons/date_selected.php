<div class="row g-3">
    <div class="col-8">
        <div class="calendar">
            <div class="calendar-header">
                <button id="prevMonth">&lt;</button>
                <span id="currentMonth"></span>
                <button id="nextMonth">&gt;</button>
            </div>
            <div class="calendar-days">
                <div class="calendar-day weekday">Dom</div>
                <div class="calendar-day weekday">Lun</div>
                <div class="calendar-day weekday">Mar</div>
                <div class="calendar-day weekday">Mié</div>
                <div class="calendar-day weekday">Jue</div>
                <div class="calendar-day weekday">Vie</div>
                <div class="calendar-day weekday">Sáb</div>
            </div>
        </div>
    </div>

    <div class="col-4">

        <div class="cs-form">
            <h3 >Date:</h3>
            <h5 id="date" style ="color: white;"></h5>

            <hr class="my-2">
            
            <h4>Horarario:</h4>
            <div class="row">
                <div class="col-4">
                    <label for="entrada" class="form-label">Inicio:</label>
                </div>

                <div class="col-8">
                    <input type="time" id="entrada">
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label for="salida" class="form-label">End:</label>
                </div>

                <div class="col-8">
                    <input type="time" id="salida">
                </div>
            </div>

            <button class="btn-primary save-button">Guardar</button>
        </div>
    </div>

</div>

<div class="table-responsive">
    <table class="table table-striped table table-bordered" id="selectedDatesTable">
        <thead  class="table-dark">
            <tr>
                <th class="date-column">Dia de la semana</th>
                <th class="day-column">Día</th>
                <th class="month-column">Mes</th>
                <th class="year-column">Año</th>
                <th>inicio de clase</th>
                <th>fin de clase</th>
            </tr>
        </thead>
        <tbody id="selectedDatesTableBody">
        </tbody>
    </table>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/date_selected.js"></script>
<link rel='stylesheet' href='../css/date_selected.css'>