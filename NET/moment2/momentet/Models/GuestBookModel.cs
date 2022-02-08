using System.ComponentModel.DataAnnotations;

namespace momentet.ModelsTwo {

    public class GuestBookModel {

        //Properties
        [Display(Name = "Ditt namn:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Author { get; set; }

        [Display(Name = "Meddelande:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        [MaxLength(244, ErrorMessage = "En meddelande kan max innehålla 244 tecken")]
        public string? Message { get; set; }

        [Display(Name = "Humör:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        public int? Feeling { get; set; }

        //public string? Timestamp { get; set; }

    }

}