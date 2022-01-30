function set_map(mymap, profesores, unidades) {

    //console.log(unidades);

    var teacherActiveIcon = new L.Icon({
        iconSize: [32, 32],
        iconAnchor: [18, 32],
        popupAnchor: [1, -24],
        iconUrl: 'static/icons/teacher_active2.png'
    })
    var teacherInActiveIcon = new L.Icon({
        iconSize: [32, 32],
        iconAnchor: [18, 32],
        popupAnchor: [1, -24],
        iconUrl: 'static/icons/teacher_inactive.png'
    })
    var teacherStanByIcon = new L.Icon({
        iconSize: [32, 32],
        iconAnchor: [18, 32],
        popupAnchor: [1, -24],
        iconUrl: 'static/icons/teacher_stanby.png'
    })
    var instituteIcon = new L.Icon({
        iconSize: [32, 32],
        iconAnchor: [18, 32],
        popupAnchor: [1, -24],
        iconUrl: 'static/icons/institute.png'
    })

    //L.marker([-2.247260, -79.90], {icon: teacherActiveIcon}).addTo(mymap);

    function addMarker(e) {
        var newMarker = new L.marker(e.latlng).addTo(mymap).setIcon(teacherActiveIcon);
        var popup = newMarker.bindPopup('<b>Docente</b>' +
            '<br/>Gracias por agregarte en el programa.<br/>' +
            'Ubicación: ' + e.latlng.lat + ', ' + e.latlng.lng);

        console.log(colors);

    };

    mymap.on('click', addMarker);

    count_teacher_a = 0;
    count_teacher_i = 0;
    count_teacher_s = 0;

    for (var i in profesores) {
        if(profesores[i][2] == 'A') {
            var newMarker = new L.marker([profesores[i][0], profesores[i][1]], {icon: teacherActiveIcon}).addTo(mymap);//
            newMarker.bindPopup('<strong style="color: #29c00e">Docente Disponible</strong><br/>' +
            '<strong>Nombre: </strong>'+profesores[i][3]+'<br/>' +
            '<strong>Teléfono: </strong>'+profesores[i][4]+'<br/>' +
            '<strong>Rating: </strong>' +
            '<span class="fa fa-star checked"></span>' +
            '<span class="fa fa-star checked"></span>' +
            '<span class="fa fa-star checked"></span>' +
            '<span class="fa fa-star"></span>' +
            '<span class="fa fa-star"></span>');
            //'<strong>Ubicación: </strong>' + ubicaciones[i][0] + ', ' + ubicaciones[i][1])

            count_teacher_a++;

        }else if(profesores[i][2] == 'I') {
            var newMarker = new L.marker([profesores[i][0], profesores[i][1]], {icon: teacherInActiveIcon}).addTo(mymap);//
            newMarker.bindPopup('<strong style="color: #c9302c">Docente No Disponible</strong><br/>' +
            '<strong>Nombre: </strong>'+profesores[i][3]+'<br/>' +
            '<strong>Teléfono: </strong>'+profesores[i][4]+'<br/>' );
            //'<strong>Ubicación: </strong>' + ubicaciones[i][0] + ', ' + ubicaciones[i][1])

            count_teacher_i++;

        }else if(profesores[i][2] == 'S') {
            var newMarker = new L.marker([profesores[i][0], profesores[i][1]], {icon: teacherStanByIcon}).addTo(mymap);//
            newMarker.bindPopup('<strong style="color: #e0a800">Docente Ocupado</strong><br/>' +
            '<strong>Nombre: </strong>'+profesores[i][3]+'<br/>' +
            '<strong>Teléfono: </strong>'+profesores[i][4]+'<br/>' );
            //'<strong>Ubicación: </strong>' + ubicaciones[i][0] + ', ' + ubicaciones[i][1])

            count_teacher_s++;

        }
    }

    for (var i in unidades) {
        //console.log(unidades[i][3] + ' ' + unidades[i][4]);
            lat = unidades[i][3];
            var newMarker = new L.marker([unidades[i][3], unidades[i][4]], {icon: instituteIcon}).addTo(mymap);//
            newMarker.bindPopup('<strong>Unidad Educativa</strong><br/>' +
                '<strong>Nombre: </strong>' + unidades[i][0] + '<br/>' +
                '<strong>Dirección: </strong>' + unidades[i][1] + '<br/>' +
                '<strong>Cant. Docentes: </strong>' + unidades[i][2] + '<br/>' +
                '<strong>Sostenimiento: </strong>' + unidades[i][5] + '<br/>' +
                '<strong>Zona: </strong>' + unidades[i][6] + '<br/>'+
                '<strong>Ubicación: </strong>' + [unidades[i][3]+','+unidades[i][4]]+'<br/>'+
                '<button onclick="more_data(\''+unidades[i][3]+'\',\''+unidades[i][4]+'\')" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">'+
                    'More info'+
                  '</button>'+
                '<div class="collapse" id="collapseExample">'+
                  '<div class="card card-body">'+
                    'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.'+
                  '</div>' +
                '</div>'
                );
    }

    total_teacher = count_teacher_a + count_teacher_i + count_teacher_s;

    document.getElementById("count_docentes").innerHTML = profesores.length;
    document.getElementById("count_inst").innerHTML = unidades.length;
    document.getElementById("teacher_a").innerHTML = (count_teacher_a*100)/total_teacher;
    document.getElementById("teacher_i").innerHTML = (count_teacher_i*100)/total_teacher;
    document.getElementById("teacher_s").innerHTML = (count_teacher_s*100)/total_teacher;
    document.getElementById("easypiechart-green").setAttribute("data-percent", (count_teacher_a*100)/total_teacher);
    document.getElementById("easypiechart-red").setAttribute("data-percent", (count_teacher_i*100)/total_teacher);
    document.getElementById("easypiechart-orange").setAttribute("data-percent", (count_teacher_s*100)/total_teacher);

};


function more_data(lat,lng){

 $.ajax({ url:'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+lat+'&lon='+lng,

     success: function(data){

        console.log(data);

        info =

        '<strong>Suburb: </strong>' + data['address']['suburb'] + '<br/>' +
        '<strong>City District: </strong>' + data['address']['city_district'] + '<br/>' +
        '<strong>City: </strong>' + data['address']['city'] + '<br/>' +
        '<strong>Town: </strong>' + data['address']['town'] + '<br/>' +
        '<strong>County: </strong>' + data['address']['county'] + '<br/>' +
        '<strong>State: </strong>' + data['address']['state'] + '<br/>' +
        '<strong>Postcode: </strong>' + data['address']['postcode'] + '<br/>' +
        '<strong>Country: </strong>' + data['address']['country'] + '<br/>' +
        '<strong>Country_code: </strong>' + data['address']['country_code'] + '<br/>';

        alert(info);
    }
 });
}



//https://data.cese.nsw.gov.au/data/dataset/nsw-public-schools-master-dataset/resource/2ac19870-44f6-443d-a0c3-4c867f04c305