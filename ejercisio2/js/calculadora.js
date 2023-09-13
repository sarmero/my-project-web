operador=0;

function clik() {
    if (operador==0 && valorar == 0) {
        document.calculadora.espacio1.value+='0'
    } else {
        if (operador==0 && valorar == 1) {
            document.calculadora.espacio1.value+='1'
        } else {
            if (operador==0 && valorar == 2) {
                document.calculadora.espacio1.value+='2'
            } else {
                if (operador==0 && valorar == 3) {
                    document.calculadora.espacio1.value+='3'
                } else { 
                    if (operador==0 && valorar == 4) {
                        document.calculadora.espacio1.value+='4'
                    } else {
                        if (operador==0 && valorar == 5) {
                            document.calculadora.espacio1.value+='5'
                        } else {
                            if (operador==0 && valorar == 6) {
                                document.calculadora.espacio1.value+='6'
                            } else {
                                if (operador==0 && valorar == 7) {
                                    document.calculadora.espacio1.value+='7'
                                } else {
                                    if (operador==0 && valorar == 8) {
                                        document.calculadora.espacio1.value+='8'
                                    } else {
                                        if (operador==0 && valorar == 9) {
                                            document.calculadora.espacio1.value+='9'
                                        }
                                        else{
                                            if (operador==1 && valorar == 0) {
                                                document.calculadora.espacio2.value+='0'
                                            } else {
                                                if (operador==1 && valorar == 1) {
                                                    document.calculadora.espacio2.value+='1'
                                                } else {
                                                    if (operador==1 && valorar == 2) {
                                                        document.calculadora.espacio2.value+='2'
                                                    } else {
                                                        if (operador==1 && valorar == 3) {
                                                            document.calculadora.espacio2.value+='3'
                                                        } else { 
                                                            if (operador==1 && valorar == 4) {
                                                                document.calculadora.espacio2.value+='4'
                                                            } else {
                                                                if (operador==1 && valorar == 5) {
                                                                    document.calculadora.espacio2.value+='5'
                                                                } else {
                                                                    if (operador==1 && valorar == 6) {
                                                                        document.calculadora.espacio2.value+='6'
                                                                    } else {
                                                                        if (operador==1 && valorar == 7) {
                                                                            document.calculadora.espacio2.value+='7'
                                                                        } else {
                                                                            if (operador==1 && valorar == 8) {
                                                                                document.calculadora.espacio2.value+='8'
                                                                            } else {
                                                                                if (operador==1 && valorar == 9) {
                                                                                    document.calculadora.espacio2.value+='9'
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function opera() {
    if (val == '+') {
        document.calculadora.espacio3.value='+';operador='1'
    } else{
        if (val == '-') {
            document.calculadora.espacio3.value='-';operador='1'
        } else {
            if (val == '*') {
                document.calculadora.espacio3.value='*';operador='1'
            } else {
                if (val == '/') {
                    document.calculadora.espacio3.value='/';operador='1'
                }
            }
        }
    }
}