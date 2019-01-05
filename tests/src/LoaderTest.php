<?php
declare(strict_types=1);

namespace Bigwhoop\LocalizedTimeZones\Tests;

use Bigwhoop\LocalizedTimeZones\Loader;
use PHPUnit\Framework\TestCase;

final class LoaderTest extends TestCase
{
    /** @test */
    public function i_can_load_using_a_locale(): void
    {
        $data = Loader::all('de_CH');
        $this->assertSame('Brunei', $data['Asia/Brunei']);
        $this->assertSame('Luxemburg', $data['Europe/Luxembourg']);
        
        $this->assertSame('Brunei', Loader::one('Asia/Brunei', 'de_CH'));
    }
    
    /** @test */
    public function i_can_load_using_a_region(): void
    {
        $data = Loader::all('de');
        $this->assertSame('Brunei Darussalam', $data['Asia/Brunei']);
        $this->assertSame('Luxemburg', $data['Europe/Luxembourg']);
        
        $this->assertSame('Brunei Darussalam', Loader::one('Asia/Brunei', 'de'));
    }
    
    /** @test */
    public function i_can_load_and_fallback_to_a_region(): void
    {
        $data = Loader::all('de_XX');
        $this->assertSame('Brunei Darussalam', $data['Asia/Brunei']);
        $this->assertSame('Luxemburg', $data['Europe/Luxembourg']);
        
        $this->assertSame('Brunei Darussalam', Loader::one('Asia/Brunei', 'de_XX'));
    }
    
    /** 
     * @test
     * @expectedException \Bigwhoop\LocalizedTimeZones\Exception
     * @expectedExceptionMessage No data found for locale 'de_XX'. 
     */
    public function i_can_fail_loading_all_because_locale_does_not_exist_and_fallback_is_disabled(): void
    {
        Loader::all('de_XX', false);
    }
    
    /** 
     * @test
     * @expectedException \Bigwhoop\LocalizedTimeZones\Exception
     * @expectedExceptionMessage No data found for locale 'xx'. 
     */
    public function i_can_fail_loading_all_because_locale_does_not_exist(): void
    {
        Loader::all('xx');
    }
    
    /** 
     * @test
     * @expectedException \Bigwhoop\LocalizedTimeZones\Exception
     * @expectedExceptionMessage No data found for locale 'xx'. 
     */
    public function i_can_fail_loading_one_because_locale_does_not_exist(): void
    {
        Loader::one('Europe/Solothurn', 'xx');
    }
    
    /** 
     * @test
     * @expectedException \Bigwhoop\LocalizedTimeZones\Exception
     * @expectedExceptionMessage No label for time zone 'Europe/Solothurn' found for locale 'de'. 
     */
    public function i_can_fail_loading_one_because_time_zone_does_not_exist(): void
    {
        Loader::one('Europe/Solothurn', 'de');
    }
}