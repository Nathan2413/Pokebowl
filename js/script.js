$(document).ready(function() {
    $('form').submit(function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: 'recherche_plats.php',
            method: 'POST',
            data: form_data,
            dataType: 'json',
            success: function(data) {
                var html = '<h2>Résultats de la recherche</h2>';
                if (data.length > 0) {
                    html += '<ul>';
                    $.each(data, function(index, plat) {
                        var link = 'dishes.php?res_id=5&action=add&id=' + index; // Specific link URL
                        html += '<li>' + plat.nom +  ' <a href="' + link + '">Ajouter au panier</a></li>';
                    });
                    html += '</ul>';
                } else {
                    html += '<p>Aucun plat ne correspond aux ingrédients sélectionnés.</p>';
                }
                $('#resultats').html(html).show();
            },
            error: function() {
                alert('Une erreur est survenue.');
            }
        });
    });
});
