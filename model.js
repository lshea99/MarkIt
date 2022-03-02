// Functions are used to show the calendar in a table format

var d = new Date();
var mnth = d.getMonth();
var yr = d.getFullYear();
d.setDate(1);
d.setMonth(0);
var month_name = ['January','February','March','April','May','June','July','August','September','October','November','December'];
var month = d.getMonth();   
var year = d.getFullYear();

function currentDay(){
    var date = new Date();
    var day = date.getDay();
    var month = date.getMonth();
    var year = date.getYear();
    document.getElementById("monthName").style.backgroundColor = "blue";
    document.getElementsByClassName("loggedInMain").style.color = "blue";
}

function currentMonth(){
    var d = new Date();
    var month_name = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    var month = d.getMonth();   
    var year = d.getFullYear(); 
    var first_date = month_name[month] + " " + 1 + " " + year;
    
    var tmp = new Date(first_date).toDateString();
    
    var first_day = tmp.substring(0, 3);    
    var day_name = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat',];
    var day_no = day_name.indexOf(first_day);   
    var days = new Date(year, month+1, 0).getDate();    
    
    var calendar = get_calendar(day_no, days);
    document.getElementById("monthName").innerHTML = month_name[month]+" "+year;
    document.getElementById("calendar-dates").appendChild(calendar);
  }

  function get_calendar(day_no, days){
    var todaysDate = new Date().getDate();
    var table = document.createElement('table');
    var tr = document.createElement('tr');
  
    
    for(var c=0; c<=18; c+=3){
        var d = c+3;
        var th = document.createElement('th');
        const dayz = "SunMonTueWedThuFriSat";
        th.innerHTML = dayz.substring(c,d);
        
        tr.appendChild(th);
    }
    table.appendChild(tr);
    
    tr = document.createElement('tr');
    var c;
    var totalCells = 42;
    for(c=0; c<=6; c++){
        if(c == day_no){
            break;
        }
        var td = document.createElement('td');
        td.className = 'blankCells';
        td.innerHTML = "";
        tr.appendChild(td);
    }
    var count = 1;
    for(; c<=6; c++){
        var td = document.createElement('td');
        if (count == todaysDate) {
          td.className = 'today';
        }
        td.innerHTML = count;
        count++;
        tr.appendChild(td);
    }
    table.appendChild(tr);
    
    for(var r=3; r<=7; r++){
        tr = document.createElement('tr');
        for(var c=0; c<=6; c++){
            if(count > days+1){
                table.appendChild(tr);
                td.className = 'blankCells';
                td.innerHTML = "";
                tr.appendChild(td);
                count++; 
            }
              
            var td = document.createElement('td');
            
            if (count == todaysDate) {
              td.className = 'today';
            }

            if(count < totalCells){
              if(count < days+1){
                td.innerHTML = count;
                count++;
                tr.appendChild(td);
            }
            else{
              table.appendChild(tr);
                td.className = 'blankCells';
                td.innerHTML = "";
                tr.appendChild(td);
                count++;
            }
          }
            else {
                td.className = 'blankCells';
                td.innerHTML = "";
                tr.appendChild(td);
                count++;
                break;
            }
            
        }
        table.appendChild(tr);
    }
  return table;
  }

  function prevMonth(){
    if(mnth==0){
      mnth = 11;
      yr--;
    }
    else{
      mnth--;
    }
    clearCalendar();
    var first_date = month_name[mnth] + " " + yr;
    
    var tmp = new Date(first_date).toDateString();
    
    var first_day = tmp.substring(0, 3);    
    var day_name = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat',];
    var day_no = day_name.indexOf(first_day);   
    var days = new Date(yr, mnth+1, 0).getDate();    
    
    var calendar = get_calendar(day_no, days);
    document.getElementById("monthName").innerHTML = month_name[mnth]+" "+yr;
    document.getElementById("calendar-dates").appendChild(calendar);

    var todaysDate = new Date().getDate();
    var table = document.createElement('table');
    var tr = document.createElement('tr');
  
    for(var c=0; c<=18; c+=3){
        var d = c+3;
        var th = document.createElement('th');
        const dayz = "SunMonTueWedThuFriSat";
        th.innerHTML = dayz.substring(c,d);
        tr.appendChild(th);
    }
    table.appendChild(tr);
    
    tr = document.createElement('tr');
    var c;
    var totalCells = 42;
    for(c=0; c<=6; c++){
        if(c == day_no){
            break;
        }
        var td = document.createElement('td');
        td.className = 'blankCells';
        td.innerHTML = "";
        tr.appendChild(td);
    }
    var count = 1;
    for(; c<=6; c++){
        var td = document.createElement('td');
        td.innerHTML = count;
        count++;
        tr.appendChild(td);
    }
    table.appendChild(tr);
    
    for(var r=3; r<=7; r++){
        tr = document.createElement('tr');
        for(var c=0; c<=6; c++){
            if(count > days+1){
                table.appendChild(tr);
                td.className = 'blankCells';
                td.innerHTML = "";
                tr.appendChild(td);
                count++; 
            }
              
            var td = document.createElement('td');
            
            if(count < totalCells){
              if(count < days+1){
                td.innerHTML = count;
                count++;
                tr.appendChild(td);
            }
            else{
              table.appendChild(tr);
                td.className = 'blankCells';
                td.innerHTML = "";
                tr.appendChild(td);
                count++;
            }
          }
            else {
                td.className = 'blankCells';
                td.innerHTML = "";
                tr.appendChild(td);
                count++;
                break;
            }
            
        }
        table.appendChild(tr);
    }
  return table;
  }

  function nextMonth(){
    if(mnth==11){
      mnth = 0;
      yr++;
    }
    else {
      mnth++;
    }
    clearCalendar();
    var first_date = month_name[mnth] + " " + yr;
    
    var tmp = new Date(first_date).toDateString();
    
    var first_day = tmp.substring(0, 3);    
    var day_name = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat',];
    var day_no = day_name.indexOf(first_day);   
    var days = new Date(yr, mnth+1, 0).getDate();    
    
    var calendar = get_calendar(day_no, days);
    document.getElementById("monthName").innerHTML = month_name[mnth]+" "+yr;
    document.getElementById("calendar-dates").appendChild(calendar);

    var todaysDate = new Date().getDate();
    var table = document.createElement('table');
    var tr = document.createElement('tr');
  
    
    for(var c=0; c<=18; c+=3){
        var d = c+3;
        var th = document.createElement('th');
        const dayz = "SunMonTueWedThuFriSat";
        th.innerHTML = dayz.substring(c,d);
        
        tr.appendChild(th);
    }
    table.appendChild(tr);
    
    tr = document.createElement('tr');
    var c;
    var totalCells = 42;
    for(c=0; c<=6; c++){
        if(c == day_no){
            break;
        }
        var td = document.createElement('td');
        td.className = 'blankCells';
        td.innerHTML = "";
        tr.appendChild(td);
    }
    var count = 1;
    for(; c<=6; c++){
        var td = document.createElement('td');
        td.innerHTML = count;
        count++;
        tr.appendChild(td);
    }
    table.appendChild(tr);
    
    for(var r=3; r<=7; r++){
        tr = document.createElement('tr');
        for(var c=0; c<=6; c++){
            // if(count > days+1){
            //     table.appendChild(tr);
            //     td.className = 'blankCells';
            //     td.innerHTML = "";
            //     tr.appendChild(td);
            //     count++; 
            // }
              
            // var td = document.createElement('td');
            
            // if(count <= days+1){
            //   td.innerHTML = count;
            //   count++;
            //   tr.appendChild(td);
            // }
            // else {
            //     td.className = 'blankCells';
            //     td.innerHTML = "";
            //     tr.appendChild(td);
            //     count++;
            //     break;
            // }
            
        }
        table.appendChild(tr);
    }
  return table;
  }

  function clearCalendar(){
      var cal = document.getElementById("calendar-dates");
      cal.innerHTML = "";
  }

  function loadMonth(){
    var d = new Date();
    var month_name = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    var month = d.getMonth();   
    var year = d.getFullYear(); 
    var first_date = month_name[month] + " " + 1 + " " + year;
    
    var tmp = new Date(first_date).toDateString();
    
    var first_day = tmp.substring(0, 3);    
    var day_name = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat',];
    var day_no = day_name.indexOf(first_day);   
    var days = new Date(year, month+1, 0).getDate();   
    
    var calendar = get_calendar(day_no, days);
    document.getElementById("monthName").innerHTML = month_name[month]+" "+year;
    document.getElementById("calendar-dates").appendChild(calendar);

    var todaysDate = new Date().getDate();
    var table = document.createElement('table');
    var tr = document.createElement('tr');
  
    
    for(var c=0; c<=18; c+=3){
        var d = c+3;
        var th = document.createElement('th');
        const dayz = "SunMonTueWedThuFriSat";
        th.innerHTML = dayz.substring(c,d);
        
        tr.appendChild(th);
    }
    table.appendChild(tr);
    
    tr = document.createElement('tr');
    var c;
    var totalCells = 42;
    for(c=0; c<=6; c++){
        if(c == day_no){
            break;
        }
        var td = document.createElement('td');
        td.className = 'blankCells';
        td.innerHTML = "";
        tr.appendChild(td);
    }
    var count = 1;
    for(; c<=6; c++){
        var td = document.createElement('td');
        if (count == todaysDate && yr == year && mnth == month) {
          td.className = 'today';
        }
        td.innerHTML = count;
        count++;
        tr.appendChild(td);
    }
    table.appendChild(tr);
    
    for(var r=3; r<=7; r++){
        tr = document.createElement('tr');
        for(var c=0; c<=6; c++){
            if(count > days+1){
                table.appendChild(tr);
                td.className = 'blankCells';
                td.innerHTML = "";
                tr.appendChild(td);
                count++; 
            }
              
            var td = document.createElement('td');
            
            if (count == todaysDate && yr == year && mnth == month) {
              td.className = 'today';
            }
            if(count < totalCells){
              if(count < days+1){
                td.innerHTML = count;
                count++;
                tr.appendChild(td);
            }
            else{
              table.appendChild(tr);
                td.className = 'blankCells';
                td.innerHTML = "";
                tr.appendChild(td);
                count++;
            }
          }
            else {
                td.className = 'blankCells';
                td.innerHTML = "";
                tr.appendChild(td);
                count++;
                break;
            }
            
        }
        table.appendChild(tr);
    }
  return table;
  }

  function monthYearAdd(){
    if(mnth==12){
      mnth = 1;
      yr++;
      document.getElementById("test").innerHTML = mnth + " " + yr;
    }
    else {
      mnth++;
      document.getElementById("test").innerHTML = mnth + " " + yr;
    }
  }

  function monthYearSub(){
    if(mnth==1){
      mnth = 12;
      yr--;
      document.getElementById("test").innerHTML = mnth + " " + yr;
    }
    else{
      mnth--;
      document.getElementById("test").innerHTML = mnth + " " + yr;
    }
  }