function number_format(amount, digits){
    const options = { style: 'currency', currency: 'COP',maximumFractionDigits : digits };
    const numberFormat = new Intl.NumberFormat('es-CO', options);
    return numberFormat.format((amount));
}

function change_format(event){
    if(!event.target.value)
        return;
    let value = event.target.value;
    const onlyNums = value.replace(/[^\d]/g, '');
    value = number_format(onlyNums, 0);
    event.target.value = value;
}
