document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        initialView: 'dayGridMonth', headerToolbar:{
            start: 'prev, next, today', center: 'title', end: 'dayGridMonth, timeGridWeek, timeGridDay, list'
        },
        editable: true,
        eventLimit: 3,
        dayMaxEvents: 3,
        slotDuration: '01:00:00',
        slotMinTime: '08:00:00',
        slotMaxTime: '18:00:00',

        dateClick: function(info){
            if(info.view.type == 'dayGridMonth' || info.view.type == 'timeGridWeek'){
                calendar.changeView('timeGrid', info.dateStr);
            }
        },

  
        events: 'agenda/listar.php',

        eventClick: function(info){
            info.jsEvent.preventDefault();
            // alert("teste");
            $('#visualizar #id').text(info.event.id);
            $('#visualizar #id').val(info.event.id);

            $('#visualizar #title').text(info.event.title);
            $('#visualizar #title').val(info.event.title);

            $('#visualizar #start').text(info.event.start.toLocaleString());
            $('#visualizar #start').val(info.event.start.toLocaleString());

            $('#visualizar #end').text(info.event.end.toLocaleString());
            $('#visualizar #end').val(info.event.end.toLocaleString());
            $('#visualizar').modal('show');
        },

        selectable: true,
        select: function(info){
            if(info.view.type == 'timeGrid'){
                // alert("Início do Evento: " + info.start.toLocaleString());
                $('#cadastrar #start').val(info.start.toLocaleString())
                $('#cadastrar #end').val(info.end.toLocaleString())  
                $('#cadastrar').modal('show');
            }
            
        }
        });
        calendar.render();
      });
            $(document).ready(function(){
            $('#cadEvento').click(function(event){
            event.preventDefault();
            $.ajax({
                url: "agenda/inserir.php",
                method: "post",
                data: $('#addEvento').serialize(),
                dataType: "text",
                success: function(mensagem){
                $('#mensagem').removeClass()
                if(mensagem == 'Salvo com Sucesso!'){
                    alert(mensagem)
                    $('#mensagem').addClass('alert alert-success')
                    // $('#btn-fechar').click();
                    // window.location = "index.php?pag="+pag;
                    location.reload();
                }else{
                    $('#mensagem').addClass('alert alert-danger')
                }
                $('#mensagem').text(mensagem)
        
                },
                
            });
            });
        
        });