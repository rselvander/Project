function giveTable(which,what,user,aid,cid) {
  var resp, tab, book, dbtable, stable, when;
  var d = new Date();
	var req = new XMLHttpRequest();
  req.responseType = 'json';

  //BUILD THE DATE FOR OUR SERVER SCRIPT
  when = d.getDay(d.setDate(d.getDate()+what));
  var bthis = "";
  bthis += String(d.getFullYear());
  bthis += "-";
  bthis += String(d.getMonth()+1);
  bthis += "-";
  if (d.getDate() < 10) {
    bthis += "0"+String(d.getDate());
  } else {
    bthis += String(d.getDate());
  }

  req.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      dbtable = "";
      resp = req.response;
      tab = JSON.parse(resp.sched);
      book = JSON.parse(resp.book);
      coa = JSON.parse(resp.coa);

      //ALL VARIABLES FOR THE LOOPY BOIS
      var totTime = tab[0].Close - tab[0].Open;
      var cont = totTime;
      var b = 0;
      var curr = (d.getHours()*60)+d.getMinutes();
      var booked = Object.keys(coa).length;
      var hour = 60*75/cont;

      dbtable += "<table style='border-collapse: collapse; width: 100%; text-align: left;'>";
      dbtable += "<colgroup><col span='1' style='width:25%'>";
      dbtable += "<colgroup><col span='1' style='min-width:37.5%;'>";
      dbtable += "<tbody><tr>";
      dbtable += "<th class='aName'>Tillgängliga tider</th>";
      dbtable += "<td style='font-size: x-large;'>"+itt(tab[0].Open)+"</td>";
      dbtable += "<td style='font-size: x-large; text-align:right;'>"+itt(tab[0].Close)+"</td>";
      dbtable += "</tr></tbody></table>";

      for (x in tab) {
        var sched = JSON.parse(tab[x].Interval);
        var timeOfDay = tab[x].Open;
        var text = "";
        //RESETING INNER TABLE
        stable = "";
        //INTERNAL COUNTERS TO HANDLE TIME
        var y = 0;
        var z = 0;
        var c = Object.keys(sched[when].day).length;

        //FORMATERING AV TABELLEN
        dbtable += "<table data-court='" + tab[x].Id + "' border='1'";
        dbtable += " style='border-collapse: collapse; width: 100%; text-align: left;'>";
        dbtable += "<colgroup><col style='width: 25%;'>";
        stable += "<tbody><tr>";
        stable += "<th class='aName'>" + tab[x].Name + "</th>";
        //PREVIOUS DAYS
        if (what < 0) {
          while(totTime > 0) {
            stable += "<td span='1' class='popup' data-booked='3'>";
            if (totTime < sched[when].day[y%c]) {
              dbtable += "<col style='width: "+ (totTime/60*hour) +"%;'>";
            } else {
              dbtable += "<col style='width: "+ (sched[when].day[y%c]/60*hour) +"%;'>";
            }
            stable += "<span class='popuptext'>Tid passerad</span>";
            stable += "</td>";
            timeOfDay += sched[when].day[y%c];
            totTime -= sched[when].day[y%c];
            y++;
          }
          //TOO FAR INTO THE FUTURE
        } else if (what > 9) {
          while(totTime > 0) {
            stable += "<td span='1' class='popup' data-booked='4'>";
            if (totTime < sched[when].day[y%c]) {
              dbtable += "<col style='width: "+ (totTime/60*hour) +"%;'>";
            } else {
              dbtable += "<col style='width: "+ (sched[when].day[y%c]/60*hour) +"%;'>";
            }
            stable += "<span class='popuptext'>Ej bokningsbar</span>";
            stable += "</td>";
            timeOfDay += sched[when].day[y%c];
            totTime -= sched[when].day[y%c];
            y++;
          }
        } else {
          while(totTime > 0) {
            stable += "<td span='1' class='popup' data-booked='";
            //NOT ENOUGH TIME LEFT TO BE BOOKABLE
            if (totTime < sched[when].day[y%c]) {
              stable += "4'>";
              text = "Ej bokningsbar";
              //TIME PASSED
            } else if (what == 0 && totTime > tab[x].Close - curr) {
              stable += "3'>";
              text = "Tid passerad";
              //IS BOOKED ALREADY
            } else if (b < Object.keys(book).length &&
                book[b].Id == tab[x].Id &&
                timeOfDay == book[b].StartMin) {
                  //ACTIVE USERS BOOKING
                  if(user == book[b].Booker) {
                    stable += "2'>";
                  //BOOKED TIME
                  } else {
                    stable += "1'>";
                  }
                  text = itt(timeOfDay) + " - " + itt(timeOfDay+sched[when].day[y%c]);
                  b++;
            //FREE SPOT
            } else {
              //MAKE SURE THAT WE ALSO ARE FREE
              if (booked == z || coa[z].Started >= timeOfDay + sched[when].day[y%c]) {
                if (z != 0 && booked == z && coa[z-1].Ended >= tab[x].Close-6 && timeOfDay >= coa[z-1].Started) {
                  stable += "4'>";
                  text = String(coa[z-1].Ended)+" "+String(tab[x].Close);
                } else {
                  stable +="0' onclick='bookMe(" + aid + "," + tab[x].Id + "," + '"' + tab[x].Name + '"';
                  stable += "," + '"' + bthis + " " + itt(timeOfDay) + ":00" + '"' + "," + '"' + bthis + " ";
                  stable += itt(timeOfDay+sched[when].day[y%c]-5) + ":00" + '"' + "," + user + ","+ cid + ")'>";
                  text = itt(timeOfDay) + " - " + itt(timeOfDay+sched[when].day[y%c]);
                }
              } else {
                stable += "4'>";
                text = "Ej bokningsbar";
              }
            }
            if (totTime < sched[when].day[y%c]) {
              dbtable += "<col>";
            } else {
              dbtable += "<col style='width: "+ (sched[when].day[y%c]/60*hour) +"%;'>";
            }
            stable += "<span class='popuptext'>" + text + "</span>";
            stable += "</td>";
            timeOfDay += sched[when].day[y%c];
            totTime -= sched[when].day[y%c];
            y++;
            if (booked != z && timeOfDay >= coa[z].Ended) {
              z++;
            }
          }
        }
        dbtable += stable;
        //FINISH ROW
        dbtable += "</tr></table>";
        totTime = cont;
      }
      //I VILKET ELEMENT DEN SKA IN
      document.getElementById("booker").innerHTML = dbtable;
    }
  }
  document.getElementById("dboi").innerHTML = "<p>"+bthis+"</p>";

  req.open("GET","coaBuild.php?q="+which+"&d="+when+"&da="+bthis+"&co="+cid,true);
  req.send();
}

function itt(tme) {
  var tam = "";
  if (tme/60 < 10) {
    tam += "0"+Math.floor(tme/60);
  } else {
    tam += Math.floor(tme/60);
  }
  tam += ":"
  if (tme%60 == 0) {
    tam += "00";
  } else {
    tam += tme%60;
  }
  return tam;
}

function bookMe(aid,cid,cname,dts,dte,uid,coa) {
  if(confirm("Boka: "+cname+" med Coach\n"+dts+" till "+dte+"?")){
      window.location.assign("./coachbooker.php?aid="+aid+
      "&cid="+cid+
      "&cname="+cname+
      "&dts="+dts+
      "&dte="+dte+
      "&uid="+uid+
      "&coa="+coa);
    }
}