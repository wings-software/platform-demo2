package hello;

import static org.hamcrest.CoreMatchers.containsString;
import static org.junit.Assert.*;

import org.junit.Test;

public class GreeterTest {

  private Greeter greeter = new Greeter();

  @Test
  public void greeterSaysHello() {
    assertThat(greeter.sayHello(), containsString("Harness"));
  }
@Test
  public void greeterSaysHello2() {
    assertThat(greeter.sayHello(), containsString("demos"));
  }
@Test
  public void greeterSaysHello3() {
    assertThat(greeter.sayHello(), containsString("demos"));
  }
@Test
  public void greeterSaysHello4() {
    assertThat(greeter.sayHello(), containsString("demos"));
  }
@Test
  public void greeterSaysHello5() {
    assertThat(greeter.sayHello(), containsString("demos"));
  }
}
