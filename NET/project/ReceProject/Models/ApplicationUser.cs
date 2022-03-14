using System.ComponentModel.DataAnnotations;
using Microsoft.AspNetCore.Identity;

namespace ReceProject.Models;

public class ApplicationUser : IdentityUser
{
    [Display(Name = "Förnamn")]
    [Required(ErrorMessage = "Kan inte lämnas tomt")]
    public string? FirstName { get; set; }

    [Display(Name = "Efternamn")]
    [Required(ErrorMessage = "Kan inte lämnas tomt")]
    public string? LastName { get; set; }
}