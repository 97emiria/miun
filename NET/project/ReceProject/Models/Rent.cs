using System.ComponentModel.DataAnnotations;

namespace ReceProject.Models;

public class Rent {
    
      public int Id { get; set; }

    //Customer info 
    [Required(ErrorMessage = "Kan inte lämnas tomt")]
    [Display(Name = "Kundens namn")]
    public string? Name { get; set; }

    [Display(Name = "Kundens telefonnumer")]
    [Required(ErrorMessage = "Kan inte lämnas tomt")]
    public string? Phone { get; set; }

    //Get Rooms list
    [Display(Name = "Rum")]
    public int RoomId {get; set; }
    public Room? Room { get; set; }



    //Note (can be empty)
    [Display(Name = "Anteckning")]
    [MaxLength(244, ErrorMessage = "En anteckning kan endast innehålla 244 tecken")]
    public string? Note { get; set; }


    [Display(Name = "Bokades av")]
    [Required(ErrorMessage = "Kan inte lämnas tomt")]
    public string? RentedByEmployee { get; set; }


    //Timestamp
    [Display(Name = "Uthyrd")]
    public DateTime TimeRentedSince { get; set; } = DateTime.Now;

}


