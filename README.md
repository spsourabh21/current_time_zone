# current_time_zone

**Story:** As a user, I should be able to see the Site location and the current time for the location.

Implementation details:
Add an ADMIN CONFIGURATION form which will take the following inputs:
1. Country - text field
2. City - text field
3. Timezone - select list (Options in the select list)
      
      1. America/Chicago
      
      2. America/New_York
      
      3. Asia/Tokyo
      
      4. Asia/Dubai
      
      5. Asia/Kolkata
      
      6. Europe/Amsterdam
      
      7. Europe/Oslo
      
      8. Europe/London
      
      
1. Create a service that will return the current time based on the time zone selection in the above form. Time should be in the format 25th Oct 2019 - 10:30 PM
2. Add a Plugin block which will render the Location from the configuration set in the ACF and the current time calling the service in the previous step. Pass the variables to a template to be rendered.

**Acceptance Criteria**
1. Since this block will be placed on all the pages, caching needs to be enabled on the block. 
      However, the time must be updated without a cache rebuild.
2. Any service calls should be done using Dependency Injection. Any direct calls to services are not allowed.
3. Your code must follow Drupal coding standards and DrupalPractice code standards.
