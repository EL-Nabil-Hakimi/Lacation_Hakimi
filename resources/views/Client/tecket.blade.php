<!DOCTYPE html>
<html>
<head>
    <title>Réservation</title>
<style>
    .reservation-details {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        max-width: 600px;
        margin: 0 auto;
    }
    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }
    img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        border-radius: 5px;
        margin-bottom: 15px;
    }
    p {
        color: #1e1e1e;
        margin-bottom: 10px;
    }
    p:last-child {
        margin-bottom: 0;
    }
</style>

<div class="reservation-details">
    <h2>Reservation Details</h2>
    <img id="imagy" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path("images/cars/" . $res[0]->car->image))) }}" alt="">
    <p>Start Date: {{ $res[0]->date_debut }}</p>
    <p>End Date: {{ $res[0]->date_fin }}</p>
    <p>License Plate: {{ $res[0]->car->matricule }}</p>
    <p>Brand: {{ $res[0]->car->marque->name }}</p>
    <p>Model: {{ $res[0]->car->model->name }}</p>
    <p>First Name: {{ $res[0]->user->client->prenom }}</p>
    <p>Last Name: {{ $res[0]->user->client->nom }}</p>
    <p>Price/day: {{ $res[0]->car->prix_par_jour }} DH</p>
    <p>Total: {{ $totalCost }} DH for {{ $totalDays }} days</p>
</div>
    
    
</body>
</html>