using System.ComponentModel.DataAnnotations;

namespace video.Models {

    public class CourseModel {

        //Properties
        [Display(Name = "Kurskod:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        [MaxLength(6)]
        public string? Code { get; set; }

        [Display(Name = "Kursnamn:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Name { get; set; }

    }

}