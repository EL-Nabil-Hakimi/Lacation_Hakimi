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
    <h2>Détails de la réservation</h2>
    <img id="imagy" src="data:image/png;base64,<?php echo e(base64_encode(file_get_contents(public_path("images/cars/" . $res[0]->car->image)))); ?>" alt="">
    <p>Date Debut: <?php echo e($res[0]->date_debut); ?></p>
    <p>Date Fin: <?php echo e($res[0]->date_fin); ?></p>
    <p>Matricule: <?php echo e($res[0]->car->matricule); ?></p>
    <p>Marque : <?php echo e($res[0]->car->marque->name); ?></p>
    <p>Model : <?php echo e($res[0]->car->model->name); ?></p>
    <p>Prenom : <?php echo e($res[0]->user->client->prenom); ?></p>
    <p>Nom : <?php echo e($res[0]->user->client->nom); ?></p>
    <p>Heure: <?php echo e($res[0]->car->prix_par_jour); ?> DH</p>
    <p>Total: <?php echo e($totalCost); ?> DH pour <?php echo e($totalDays); ?> jours</p>
</div>
    
    
</body>
</html><?php /**PATH C:\Users\YouCode\Documents\Mes Projets\fileRouge\Location_Hakimi\resources\views/client/tecket.blade.php ENDPATH**/ ?>