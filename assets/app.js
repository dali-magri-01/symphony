import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './css/modern.css';
import './js/app.js';
import './js/settings.js';
import 'simplebar/dist/simplebar.min.css';


// Importez Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';

// Importez Bootstrap JS
import 'bootstrap/dist/js/bootstrap.bundle.min';
import 'datatables.net-bs5/js/dataTables.bootstrap5.min';


import "bootstrap";
import "fullcalendar";
import "./settings.js";

import 'select2/dist/css/select2.min.css';
import $ from 'jquery'; // Import de jQuery
import 'perfect-scrollbar';
import 'metismenu';
import 'datatables.net-dt';
import 'datatables.net-buttons-dt';
import 'datatables.net-bs5';
import 'daterangepicker';


// Forms
import "datetimepicker";
import "mask";
import "select2";
import "validation";
import "wizard";
import 'datatables.net-buttons/js/dataTables.buttons';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import 'jszip/dist/jszip'; // Importez JSZip pour la génération de ZIP (obligatoire pour PDFMake)
import 'pdfmake/build/pdfmake'; // Importez PDFMake
import 'pdfmake/build/vfs_fonts'; // Importez les polices de caractères pour PDFMake
import 'datatables.net-buttons';
import 'jszip';
import 'pdfmake';

import jsPDF from 'jspdf';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
$(document).ready(function () {
    $('#example').DataTable();
});
$(document).ready(function () {
    $('#tiers').DataTable();
});

$(document).ready(function () {
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('passwordInput');
        const togglePasswordButton = document.getElementById('togglePassword');

        togglePasswordButton.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    });


    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });
});



$(document).ready(function () {

    var table = $('#example2').DataTable({
        // Configuration de la table DataTable
        paging: true,
        searching: true,
        ordering: true,
        // language: {
        //     lengthMenu: 'Afficher _MENU_ éléments par page',
        //     search: 'Rechercher :',
        //     zeroRecords: 'Aucun enregistrement trouvé',
        //     info: 'Affichage de _START_ à _END_ sur _TOTAL_ enregistrements',
        //     infoEmpty: 'Aucun enregistrement disponible',
        //     infoFiltered: '(filtré de _MAX_ enregistrements au total)'
        // },
        buttons: [
            {
                extend: 'copy',
                title: 'Copy',

                className: 'custom-copy-button', // Appliquez la classe personnalisée au bouton de copie
            },
            {
                extend: 'excel',
                className: 'custom-excel-button', // Appliquez la classe personnalisée au bouton Excel
            },
            {
                extend: 'csv',
                className: 'custom-csv-button', // Appliquez la classe personnalisée au bouton Excel
            },
            {
                extend: 'pdf',
                className: 'custom-pdf-button', // Appliquez la classe personnalisée au bouton PDF
                customize: function (doc) {
                    // Customize the PDF here
                }

            },
            {
                extend: 'print',
                className: 'custom-print-button', // Appliquez la classe personnalisée au bouton d'impression
            },
        ],
        select: true,
        dom: 'Bfrtip',
        columnDefs: [
            {
                targets: [1],
                className: 'dt-right'
            }
        ]
    });

});