const daysTag = documento . querySelector ( ".días" ) ,
fechaActual = documento . querySelector ( ".fecha-actual" ) ,
prevNextIcon = documento . querySelectorAll ( ".icons span" ) ;
// obteniendo nueva fecha, año y mes actual
let fecha = nueva Fecha ( ) , 
currYear = fecha. obtenerAñoCompleto ( ) ,
currMonth = fecha. obtenerMes ( ) ;
// almacenar el nombre completo de todos los meses en la matriz
meses constantes = [ "enero" , "febrero" , "marzo" , "abril" , "mayo" , "junio" , "julio" ,
              "agosto" , "septiembre" , "octubre" , "noviembre" , "diciembre" ] ;
const renderCalendar = ( ) => {  
    let firstDayofMonth = nueva fecha ( currYear, currMonth, 1 ) . getDay ( ) , // obteniendo el primer día del mes 
    lastDateofMonth = nueva fecha ( currYear, currMonth + 1 , 0 ) . getDate ( ) , // obteniendo la última fecha del mes 
    lastDayofMonth = nueva fecha ( currYear, currMonth, lastDateofMonth ) . getDay ( ) , // obteniendo el último día del mes 
    lastDateofLastMonth = nueva fecha ( currYear, currMonth, 0 ) . obtenerFecha ( ) ; // obteniendo la última fecha del mes anterior 
    let liTag = "" ;
    for ( let i = primerDíadelMes; i > 0 ; i-- ) { // creando li del mes anterior últimos días   
        liTag += `<li class="inactive"> ${lastDateofLastMonth - i + 1} </li>` ;
    }
    for ( let i = 1 ; i <= lastDateofMonth; i++ ) { // creando li de todos los días del mes actual   
        // agregar clase activa a li si el día, mes y año actuales coinciden
        let isToday = i === fecha. getDate ( ) && currMonth === nueva fecha ( ) . obtenerMes ( )  
                     && currYear === nueva fecha ( ) . obtenerAñoCompleto ( ) ? "activo" : "" ; 
        liTag += `<li class=" ${isToday} "> ${i} </li>` ;
    }
    for ( let i = lastDayofMonth; i < 6 ; i++ ) { // creando li del próximo mes primeros días   
        liTag += `<li class="inactive"> ${i - últimoDíadelMes + 1} </li>`
    }
    fecha actual. textoInterior = ` ${meses[mesActual]} ${añoActual} ` ; // pasando el mes y el año actuales como texto de fecha actual 
    DíasEtiqueta. HTML interno = liTag;
}
renderCalendar ( ) ;
prevNextIcon. forEach ( icon => { // obtener los iconos anterior y siguiente  
    icono. addEventListener ( "clic" , ( ) => { // agregar evento de clic en ambos íconos   
        // si el icono en el que se hizo clic es el icono anterior, disminuya el mes actual en 1; de lo contrario, incremente en 1
        currMonth = icono. id === "anterior" ? currMonth - 1 : currMonth + 1 ;
        if ( currMonth < 0 || currMonth > 11 ) { // si el mes actual es menor que 0 o mayor que 11  
            // creando una nueva fecha del mes y año actual y pasándola como valor de fecha
            fecha = nueva fecha ( añoactual, mesactual, nueva fecha ( ) . obtener fecha ( ) ) ;  
            currYear = fecha. obtenerAñoCompleto ( ) ; // actualizando el año actual con la nueva fecha año
            currMonth = fecha. obtenerMes ( ) ; // actualizando el mes actual con la nueva fecha del mes
        } más {  
            fecha = nueva Fecha ( ) ; // pasar la fecha actual como valor de fecha 
        }
        renderCalendar ( ) ; // llamando a la función renderCalendar
    } ) ;
} ) ;