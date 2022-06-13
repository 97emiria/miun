using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ReceProject.Models;

public class Room {

    public int Id { get; set; }

    //Name
    [Display(Name = "Namn")]
    [Required(ErrorMessage = "Kan inte lämnas tomt")]
    public string? Name {get; set; }

    
    //Price
    [Display(Name = "Pris/timme")]
    [Required(ErrorMessage = "Kan inte lämnas tomt")]
    public int? Price {get; set; }


    //Description
    [Display(Name = "Beskrivning")]
    [Required(ErrorMessage = "Kan inte lämnas tomt")]
    public string? Description { get; set; }


    //Image
    [Display(Name = "Bildnamn")]
    public string? ImageName { get; set; }
    [NotMapped] //Sparas inte i db
    [Display(Name = "Bild")]
    public IFormFile? ImageFile { get; set; }

    //Timestamp
    [Display(Name = "Senast uppdaterad")]
    public DateTime LastUpdated { get; set; } = DateTime.Now;
}
