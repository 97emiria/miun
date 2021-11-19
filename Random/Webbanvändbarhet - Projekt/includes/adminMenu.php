
<style> 
.adminMenu {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background-color: hsla(0, 0%, 10%, 0.4);
    z-index: 500;
    height: 30px;
    text-align: center;
}

.adminMenu a {
    color: white;
    text-decoration: none;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    margin: 0.25em 1em;
    display: inline-block;
}

.adminMenu a:hover {
    transform: scale(1.1);
}
</style>

<nav class="adminMenu">
    <a href="index.php">Index</a>
    <a href="login.php">Login</a>
    <a href="profile.php">Profil</a>
    <a href="info.php">Info</a>
    <a href="booking.php">Boka</a>
    <a href="bookConfirm.php">Bekräfta</a>
    <a href="bookEnd.php">Bokingsbekräftelsen</a>
    <a href="profileFutureBooking.php">Framtiden</a>
    <a href="profileOldBooking.php">Gamla</a>
    <a href="bookRebook.php">Omboka</a>
    <a href="alertMessageExempel.php">Avbryt/Felmeddelande</a>
</nav>