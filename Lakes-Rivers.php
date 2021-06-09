<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blue Life - Λίμνες/Ποτάμια</title>
    <link rel="icon" href="images/Main/BlueLife-icon.ico">
    <link rel="stylesheet" href="styles_main.css">
    <link rel="stylesheet" href="styles_categories.css">
</head>
<body>

<header id="header">
    <h1>Blue Life</h1>
</header>

<!---------------Navigation bar--------------->
<?php include("navigation.php") ?>

<!---------------Title section--------------->
<div class="page-title">
    <div class='vidContain'>
        <div class='vid'>
            <video autoplay muted loop>
                <source src="images/Main/Underwater.mp4">
            </video>
        </div>
        <h2>Λίμνες/Ποτάμια</h2>
    </div>
</div>

<!---------------Λίμνες-Ποτάμια--------------->
<div class="category_content">
    <h3>Λίμνες στην Ελλάδα</h3>
    <img src="images/2.Categories/Lakes-Rivers_Lake1.jpg" alt="lake" >
    <p>Στην Ελλάδα υπάρχουν δεκάδες φυσικές και τεχνητές λίμνες καθώς και πολλές λιμνοθάλασσες. Οι περισσότερες
        λίμνες περιέχουν γλυκό νερό και έχουν σχηματιστεί, κυρίως, μακριά από τις ακτές της θάλασσας ως αποτέλεσμα
        τεκτονικών ή ηφαιστειακών δυνάμεων ή από την τήξη των παγετώνων. Οι λιμνοθάλασσες, που είναι αβαθείς
        παράκτιες υδατοσυλλογές οι οποίες επικοινωνούν με τη θάλασσα μέσω ενός μικρότερου ή μεγαλύτερου ανοίγματος,
        μπορεί να μετατραπούν σε λίμνες γλυκού νερού, όταν για κάποιο λόγο διακοπεί η εισροή αλμυρού νερού από
        τη θάλασσα και παρουσιαστεί ικανοποιητική εισροή γλυκού νερού από ρέουσες υδατοσυλλογές.<br>
        Υπάρχουν και λίμνες με αλμυρό ή υφάλμυρο νερό, όταν το υπόστρωμά τους περιέχει πολλά διαλυτά άλατα ή όταν
        δέχονται εισροές αλμυρού νερού. Οι τεχνητές λίμνες, που δημιουργήθηκαν από την κατασκευή φραγμάτων σε ρυάκια,
        χείμαρρους ή ποτάμια ώστε να αποταμιεύουν το νερό τους για ποικίλους σκοπούς (άρδευση, γεωργία, ύδρευση κ.λπ.),
        είναι η σπουδαιότερη κατηγορία τεχνητών υγρότοπων στην Ελλάδα. Καλύπτουν σημαντική έκταση και έχουν συμβάλλει
        στη δημιουργία σημαντικών οικοσυστημάτων στο ελληνικό υγροτοπικό κεφάλαιο.
    </p>
</div>

<div class="category_content">
    <h3>Μεγαλύτερες λίμνες του κόσμου</h3>
    <img src="images/2.Categories/Lakes-Rivers_River.jpg" alt="lake">
    <p>Οι μεγαλύτερες σε έκταση λίμνες του κόσμου άνω των 10.000 τ.χλμ. είναι οι παρακάτω:</p>
    <table>
        <tr>
            <th ></th>
            <th>Όνομα</th>
            <th>Τοποθεσία</th>
            <th >Μέγεθος</th>
        </tr>
        <tr>
            <td>1.</td>
            <td>Κασπία Θάλασσα</td>
            <td>Ευρώπη-Ασία</td>
            <td>371.000 τ.χλμ.</td>
        </tr>
        <tr>
             <td>2.</td>
             <td>Λίμνη Μίσιγκαν-Χιούρον</td>
             <td>Αμερική</td>
             <td>117.800 τ.χλμ.</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Σουπίριορ</td>
            <td>Β. Αμερική</td>
            <td>82.100 τ.χλμ.</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Βικτωρία</td>
            <td>Αφρική</td>
            <td>68.422 τ.χλμ.</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Αράλη</td>
            <td>Ασία</td>
            <td>66.458 τ.χλμ.</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Ταγκανίκα</td>
            <td>Αφρική</td>
            <td>32.892 τ.χλμ</td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Βαϊκάλη</td>
            <td>Ασία</td>
            <td>31.500 τ.χλμ.</td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Νυάσσα</td>
            <td>Αφρική</td>
            <td>31.000 τ.χλμ.</td>
        </tr>
        <tr>
            <td>9.</td>
            <td>Μεγάλη Λίμνη των Άρκτων</td>
            <td>Β. Αμερική</td>
            <td>31.000 τ.χλμ.</td>
        </tr>
        <tr>
            <td>10.</td>
            <td>Μεγάλη Λίμνη των Σκλάβων</td>
            <td>Β. Αμερική</td>
            <td>27.000 τ.χλμ.</td>
        </tr>
        <tr>
            <td>11.</td>
            <td>Ηρι</td>
            <td>Β. Αμερική</td>
            <td>25.800 τ.χλμ.</td>
        </tr>
        <tr>
            <td>12.</td>
            <td>Γουίνιπεγκ</td>
            <td>Β. Αμερική</td>
            <td>24.600 τ.χλμ.</td>
        </tr>
        <tr>
            <td>13.</td>
            <td>Μπαλκάς</td>
            <td>Ασία</td>
            <td>20.600 τ.χλμ.</td>
        </tr>
        <tr>
            <td>14.</td>
            <td>Μπαλκάς</td>
            <td>Ασία</td>
            <td>20.600 τ.χλμ.</td>
        </tr>
        <tr>
            <td>15.</td>
            <td>Οντάριο</td>
            <td>Β. Αμερική</td>
            <td>18.750 τ.χλμ.</td>
        </tr>
        <tr>
            <td>16.</td>
            <td>Λάντογκα</td>
            <td>Ευρώπη</td>
            <td>18.130 τ.χλμ.</td>
        </tr>
        <tr>
            <td>17.</td>
            <td>Λίμνη Τσαντ</td>
            <td>Αφρική</td>
            <td>18.000 τ.χλμ.</td>
        </tr>
        <tr>
            <td>18.</td>
            <td>Λίμνη Ροδόλφου</td>
            <td>Αφρική</td>
            <td>10.250 τ.χλμ.</td>
        </tr>
    </table>
</div>

<div class="category_content">
    <h3>Επεμβάσεις στους Ποταμούς</h3>
    <img src="images/2.Categories/Lakes-Rivers_Lake2.jpg" alt="river" >
    <p>Σήμερα παρουσιάζονται αναπτυξιακά σχέδια που αποτελούν νέο κύμα διευθετήσεων και επεμβάσεων για μερικούς
        από τους τελευταίους μεγάλους ποταμούς, που έχουν μείνει ανεπηρέαστοι μέχρι σήμερα(Rosenberg & Bodaly, 1994).
        Εκτιμάται ότι μέχρι το έτος 2000 θα έχουν γίνει παρεμβάσεις στο 60% περίπου των ρευμάτων και ποταμών
        παγκοσμίως (Petts, 1989).
        <br>
        Αν και τα φράγματα αποτελούν τη μεγαλύτερη τεχνική ανθρώπινη επέμβαση στους ποταμούς, τα ποτάμια συστήματα
        απειλούνται και από διάφορες άλλες επεμβάσεις, όπως: άντληση νερού, αλλαγές στη μορφή της κοίτης τους,
        δημιουργία αρδευτικών καναλιών, ευθυγραμμίσεις, εκτροπές, κλπ. Όλες αυτές αλλοιώνουν τη ροή του ποταμού
        και μεταβάλλουν τα ενδοποτάμια αλλά και τα παραποτάμια ενδιαιτήματα. Παράλληλα:<br>
        Η εντατική χρήση γης με αποψιλώσεις, εντατικές καλλιέργειες και αύξηση των εγκαταστάσεων, επιδρά στα ποτάμια,
        συντελώντας και στη μεταβολή του τοπίου. Ορισμένες αλλαγές φαινομενικά μικρής σημασίας, θα πρέπει στο
        μέλλον να εξετασθούν με περισσότερη σοβαρότητα.<br>
        Οι ανάγκες για νερό στον 21ο αιώνα θα εντείνουν την πίεση για σχέδια μεταφοράς και λήψης νερού (Cleick, 1993).<br>
        Η μεταφορά και εξάπλωση ξενόφερτων ειδών, η οποία έχει ενταθεί κατά τον 20ο αιώνα, απειλεί να μεταβάλλει
        τη σύνθεση των ειδών ορισμένων περιοχών.<br>
        Η ρύπανση από οργανικές ουσίες και βιομηχανικά απόβλητα, αν και μειώθηκε κάπως τα τελευταία 20 χρόνια,
        αποτελεί μόνιμη απειλή για την ποιότητα του νερού των εντονότερα διαχειριζόμενων ποταμών της Ευρώπης και
        της Β. Αμερικής, αλλά και των ποταμών των υπό ανάπτυξη χωρών.<br>
        Τέλος, η επερχόμενη παγκόσμια αλλαγή του κλίματος της γης κατά τον 21ο αιώνα, η οποία οφείλεται στην
        ατμοσφαιρική μεταφορά ρύπανσης σε μεγάλες αποστάσεις, στο φαινόμενο θερμοκηπίου, στην «τρύπα» του όζοντος,
        στην υπερκατανάλωση των ορυκτών καυσίμων που ελευθερώνει στο περιβάλλον «ενταφιασμένη» ενέργεια, και
        επομένως στις μεταβολές της θερμοκρασίας και των βροχοπτώσεων, μεταβάλλει τη φυσική κατάσταση πολλών
        ποτάμιων συστημάτων.
        Τα ποτάμια παγκοσμίως συνεχίζουν να αποτελούν αντικείμενο συνεχών παρεμβάσεων, με σοβαρές επιπτώσεις στη
        δομή και τη λειτουργία τους.
    </p>

    Πηγές: <br>
    <a href="https://el.m.wikipedia.org/wiki/%CE%9B%CE%AF%CE%BC%CE%BD%CE%B7?fbclid=IwAR3-bcybMW9c4D2CHFHRQHdq6-ywtWeeXQurY1o8rlrBlxo6Ymg5lx9fWG0" target="_blank">Βικιπαίδεια</a>,
    <a href="http://river.bio.auth.gr/language/el/2-%CF%84%CE%BF-%CE%B4%CE%AC%CE%BC%CE%B1%CF%83%CE%BC%CE%B1-%CF%84%CF%89%CE%BD-%CF%80%CE%BF%CF%84%CE%B1%CE%BC%CF%8E%CE%BD-%CE%BC%CE%AD%CF%83%CE%B1-%CE%B1%CF%80%CF%8C-%CF%84%CE%B7%CE%BD-%CE%B9%CF%83/?fbclid=IwAR2VHJaly6AkapSnnaL3Qg4nSSlawgNJfiX5dVoXCN32re-GfiNreGwUBt4" target="_blank">Μονάδα Ποιότητας Ποτάμιων Συστημάτων</a>
</div>

<!-----------------Go to top button----------------->
<?php include("go_top_button.html"); ?>

<!-----------------Footer----------------->
<?php include("footer.html");?>


</body>
</html>