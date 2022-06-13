using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ReceProject.Models;

public class News {

    public int Id { get; set; }

    //Header
    [Display(Name = "Rubrik")]
    [Required(ErrorMessage = "Kan inte lämnas tomt")]    
    public string? Header { get; set; }

    //Text
    [Display(Name = "Nyheten")]
    [Required(ErrorMessage = "Kan inte lämnas tomt")]
    public string? Text { get; set; }
    
    //Hashtags for search
    [Display(Name = "Hashtags")]
    public string? Hashtags { get; set; } 

    
    //Author = sign in persons name
    [Display(Name = "Skribent")]
    public string? Author { get; set; }

    //Image
    [Display(Name = "Bildnamn")]
    public string? ImageName { get; set; }
    [NotMapped] //Sparas inte i db
    [Display(Name = "Bild")]
    public IFormFile? ImageFile { get; set; }


    //Timestamps
    [Display(Name = "Publicerades")]
    public string? Publish { get; set; }
    

    [Display(Name = "Ändrades senast")]
    public DateTime LastUpdated { get; set; } = DateTime.Now;

}