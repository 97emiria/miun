using System.ComponentModel.DataAnnotations;

namespace CatApi.Models;

public class Cat {
    public int Id { get; set; } 
    [Required]
    
    public string? Name { get; set; }
    [Required]
    public int? Age { get; set; }

    public bool Adopted { get; set; } = false;

    public DateTime? Registered { get; set; } = DateTime.Now;
}