var builder = WebApplication.CreateBuilder(args);

//MVC 
builder.Services.AddControllersWithViews();
var app = builder.Build();

//Statiska filer / wwwroot
app.UseStaticFiles();
app.UseRouting();

app.MapControllerRoute(
    name: "default",
    pattern: "{controller=Home}/{action=Index}/{id?}"
);

app.Run();
