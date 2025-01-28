<?php
// Función para formatear el número de teléfono
function formatPhoneNumber($number)
{
    // Asegúrate de que el número solo contenga dígitos
    $number = preg_replace('/[^0-9]/', '', $number);

    // Verifica si tiene exactamente 10 dígitos
    if (strlen($number) === 10) {
        // Aplica el formato deseado: (XXXX) XXX XXX
        return '(' . substr($number, 0, 4) . ') ' . substr($number, 4, 3) . ' ' . substr($number, 7);
    }

    // Si no tiene 10 dígitos, retorna el número tal como está
    return $number;
}
